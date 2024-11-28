<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-4 px-2 sm:py-8 md:py-12 sm:px-4 md:px-6 lg:px-8 relative">
    <a href="/" class="inline-flex items-center mb-6 hover:opacity-80 transition-opacity">
        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span class="text-blue-500 text-lg sm:text-xl md:text-2xl">Back</span>
    </a>

    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6 text-center">Employees</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto scrollbar-thin">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-2 sm:px-4 md:px-6 md:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-3 py-2 sm:px-4 md:px-6 md:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                                <th scope="col" class="hidden md:table-cell px-3 py-2 sm:px-4 md:px-6 md:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-3 py-2 sm:px-4 md:px-6 md:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="hidden sm:table-cell px-3 py-2 sm:px-4 md:px-6 md:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">State</th>
                                <th scope="col" class="px-3 py-2 sm:px-4 md:px-6 md:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($employees as $employee)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-3 py-2 sm:px-4 md:px-6 md:py-4 whitespace-nowrap text-xs sm:text-sm font-medium text-gray-900">{{ $employee->firstName }}</td>
                                    <td class="px-3 py-2 sm:px-4 md:px-6 md:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{ $employee->firstLastName }}</td>
                                    <td class="hidden md:table-cell px-3 py-2 sm:px-4 md:px-6 md:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{ $employee->email }}</td>
                                    <td class="px-3 py-2 sm:px-4 md:px-6 md:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{ $employee->doc }}</td>
                                    <td class="hidden sm:table-cell px-3 py-2 sm:px-4 md:px-6 md:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ ucfirst($employee->state) }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 sm:px-4 md:px-6 md:py-4 whitespace-nowrap text-xs sm:text-sm font-medium">
                                        <div class="flex space-x-2 sm:space-x-3">
                                            <button onclick="editEmployee({{ json_encode($employee) }})" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200">Edit</button>
                                            <button onclick="deleteEmployee({{$employee->id}})" class="text-red-600 hover:text-red-900 transition-colors duration-200">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-2 sm:px-4 md:px-6 md:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500 text-center">No employees have been created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="overlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto max-h-[90vh] overflow-y-auto">
            <div class="p-4 sm:p-6 md:p-8">
                <h2 id="formTitle" class="text-xl sm:text-2xl font-bold mb-6">Edit Employee</h2>
                <form id="employeeForm" class="space-y-4">
                    <input type="hidden" id="employeeId" name="id">
                    <div class="space-y-4">
                        <div>
                            <label for="firstLastName" class="block text-sm font-medium text-gray-700 mb-1">First Last Name</label>
                            <input required type="text" name="firstLastName" id="firstLastName" class="uppercase w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base px-3 py-2">
                        </div>
                        <div>
                            <label for="secondLastName" class="block text-sm font-medium text-gray-700 mb-1">Second Last Name</label>
                            <input required type="text" name="secondLastName" id="secondLastName" class="uppercase w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base px-3 py-2">
                        </div>
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input required type="text" name="firstName" id="firstName" class="uppercase w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base px-3 py-2">
                        </div>
                        <div>
                            <label for="middleName" class="block text-sm font-medium text-gray-700 mb-1">Middle Name(s)</label>
                            <input type="text" name="middleName" id="middleName" class="uppercase w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base px-3 py-2">
                        </div>
                        <div>
                            <label for="doc" class="block text-sm font-medium text-gray-700 mb-1">ID number</label>
                            <input required type="text" name="doc" id="doc" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base px-3 py-2">
                        </div>
                        <div>
                            <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                            <select required name="area" id="area" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base px-3 py-2">
                                <option value="" disabled>Select One</option>
                                <option value="administration">Administration</option>
                                <option value="finance">Finance</option>
                                <option value="operations">Operations</option>
                                <option value="hResources">Human Resources</option>
                            </select>   
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 pt-6">
                        <button type="button" onclick="closeOverlay()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition-colors duration-200 text-sm sm:text-base font-medium">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200 text-sm sm:text-base font-medium">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function deleteEmployee(employeeId) {
        if (confirm("Are you sure you want to delete this employee?")) {
            fetch(`api/delete/${employeeId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Employee deleted successfully.");
                    location.reload();
                } else {
                    alert('Something went wrong.')
                }
            }) 
            .catch(error => {
                console.error(error);
                alert("Something went wrong.");
            });
        }
    }

    const inputUppercase = document.querySelectorAll('.uppercase');
    inputUppercase.forEach(input => {
        input.addEventListener('input', () => {
            input.value = input.value.toUpperCase();
        });
    });

    function editEmployee(employee) {
        document.getElementById('formTitle').textContent = 'Edit Employee';
        document.getElementById('employeeId').value = employee.id;
        document.getElementById('firstLastName').value = employee.firstLastName;
        document.getElementById('secondLastName').value = employee.secondLastName;
        document.getElementById('firstName').value = employee.firstName;
        document.getElementById('middleName').value = employee.middleName || '';
        document.getElementById('doc').value = employee.doc;
        document.getElementById('area').value = employee.area;
        
        document.getElementById('overlay').classList.remove('hidden');
        document.getElementById('overlay').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeOverlay() {
        document.getElementById('overlay').classList.add('hidden');
        document.getElementById('overlay').classList.remove('flex');
        document.getElementById('employeeForm').reset();
        document.body.style.overflow = '';
    }

    document.getElementById('employeeForm').addEventListener('submit', function (event) {
        event.preventDefault();
        
        const form = event.target;
        const employeeId = form.querySelector('#employeeId').value;
        
        const formData = new FormData();
        formData.append('id', form.querySelector('#employeeId').value);
        formData.append('firstLastName', form.querySelector('#firstLastName').value);
        formData.append('secondLastName', form.querySelector('#secondLastName').value);
        formData.append('firstName', form.querySelector('#firstName').value);
        formData.append('middleName', form.querySelector('#middleName').value);
        formData.append('doc', form.querySelector('#doc').value);
        formData.append('area', form.querySelector('#area').value);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('_method', 'PUT');

        fetch(`api/edit/${employeeId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Employee updated successfully.");
                location.reload();
            } else {
                let errorMessage = 'Error updating employee:\n';
                if (data.errors) {
                    for (let field in data.errors) {
                        errorMessage += `${field}: ${data.errors[field].join(', ')}\n`;
                    }
                } else {
                    errorMessage += data.message || 'Unknown error occurred.';
                }
                alert(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An unexpected error occurred. Please try again.");
        });
    });
    </script>
</body>
</html>