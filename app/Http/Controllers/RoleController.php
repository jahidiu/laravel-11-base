<?php

namespace App\Http\Controllers;

use App\Repository\Eloquents\RoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct(private RoleRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
    $data = $this->repository->allDataTable();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $editUrl   = route('role.edit', $row->id);
            $assignUrl = route('role.permission', $row->id);
            $deleteUrl = route('role.destroy', $row->id);

            $btn = '<div class="btn-group" role="group" aria-label="Basic example">';

            // Only show Edit if user has permission
            if (auth()->user()->can('role.edit')) {
                $btn .= '<button type="button" class="btn btn-warning btn-sm editBtn"
                            data-id="' . $row->id . '" data-url="' . $editUrl . '">
                            <i class="bi bi-pencil-fill"></i>
                         </button>';
            }

            // Only show Assign permission if allowed
            if (auth()->user()->can('role.permission')) {
                $btn .= '<a href="' . $assignUrl . '" class="btn btn-info btn-sm">
                            <i class="bi bi-shield-fill-check"></i>
                         </a>';
            }

            // Only show Delete if user can delete roles
            if (auth()->user()->can('role.delete')) {
                $btn .= '<button type="button" class="btn btn-danger btn-sm" style="border-radius: 0 0.25rem .25rem 0;"
                            onclick="confirmDelete(' . $row->id . ')">
                            <i class="bi bi-trash-fill"></i>
                         </button>';
                $btn .= '<form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '"
                            method="POST" style="display:none;">
                            ' . csrf_field() . method_field('DELETE') . '
                         </form>';
            }

            $btn .= '</div>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
}


        return view('backend.role.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        try {
            $this->repository->create($data);
            return back()->with('success', 'Event Type Created Successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $eventType = $this->repository->findById($id);
        return response()->json($eventType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
            ]);

            $this->repository->update($id, $data);

            // Return JSON for success
            return response()->json(['message' => 'Event Type Updated Successfully!']);
        } catch (ValidationException $e) {
            // Return validation errors as JSON
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            // Return general errors as JSON
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->repository->deleteById($id);
            return back()->with('success', 'Event Type Deleted Successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function rolePermission($id)
    {
        $role = Role::findOrFail($id);

        // Group permissions by 'group_name'
        $permissionGroups = Permission::all()->groupBy('group_name');

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('backend.role.assign-permission', [
            'role' => $role,
            'permissionGroups' => $permissionGroups,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function roleAssignPermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array', // optional if unchecking all
        ]);

        $role = Role::findOrFail($request->role_id);

        // Convert permission IDs to names
        $permissionNames = [];
        if (!empty($request->permissions)) {
            $permissionNames = Permission::whereIn('id', $request->permissions)
                ->where('guard_name', 'web')
                ->pluck('name')
                ->toArray();
        }

        $role->syncPermissions($permissionNames);

        return redirect()->back()->with('success', 'Permissions assigned successfully.');
    }

    public function get_for_select(Request $request)
    {
        $data = $this->repository->getServerSideDataForSelectOption($request->search, [], ['name'], 'id', 'name', '10');
        return response()->json($data);
    }
}
