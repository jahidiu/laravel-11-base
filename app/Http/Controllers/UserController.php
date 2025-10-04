<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\Eloquents\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(private UserRepository $repository) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->allDataTable([], ['*'], ['role']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return $row->role?->name ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return view('backend.includes.action', [
                        'routeEditByModal' => route('user.edit', $row->id),
                        'routeDelete' => ($row->id == 1) ? null : route('user.destroy', $row->id) ,
                        'id' => $row->id,
                        'canEdit'     => auth()->user()->can('user.edit'),
                        'canDelete'   => auth()->user()->can('user.delete'),
                    ]);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('backend.user.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            // Hash the password
            $data['password'] = Hash::make($data['password']);

            // Create the user
            $user = $this->repository->create($data);

            // Assign role
            $role = Role::findById($request->role_id);
            $user->assignRole($role);

            return back()->with('success', 'User Created and Role Assigned Successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userType = $this->repository->findById($id);
        return response()->json($userType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'role_id' => 'required|exists:roles,id',
            ]);

            $user = $this->repository->findById($id);
            $user->update($data);

            return response()->json(['message' => 'User Updated Successfully!']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (in_array($id, [1, 2])) {
                return back()->with('error', 'This user cannot be deleted.');
            }
            $this->repository->deleteById($id);
            return back()->with('success', 'User Deleted Successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
