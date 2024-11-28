<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        @vite('resources/css/app.css')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-blue-900 via-gray-900 to-blue-900 flex flex-col items-center justify-center p-4">

        <main class="text-white py-6 px-10 bg-white bg-opacity-10 p-8 rounded-2xl shadow-2xl shadow-[#92929294] backdrop-blur-xl border border-blue-300/15">
            <div class="flex justify-center">
                <img class=" w-[300px] cursor-pointer" fetchpriority="high" width="1255" height="276" src="https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color.png" class="attachment-full size-full wp-image-401" alt="" srcset="https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color.png 1255w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-300x66.png 300w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-1024x225.png 1024w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-768x169.png 768w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-18x4.png 18w" sizes="(max-width: 1255px) 100vw, 1255px">
            </div>
            <section class="flex flex-col">
                <h2 class="text-center text-xl font-medium text-blue-300 mb-4">Register Employee</h2>
                
                <form class="md:px-2 flex flex-col gap-4 [&>div]:flex [&>div]:justify-between  [&>div]:md:flex-row [&>div]:flex-col [&>div]:md:gap-2 [&>div>input]:px-2 [&>div>select]:px-2" id="registerForm" action="api/register" method="post">
                    <div>
                        <label for="firstLastName">First Last Name:</label>
                        <input required type="text" name="firstLastName" id="firstLastName" class="uppercase">
                    </div>
                    <div>
                        <label for="secondLastName">Second Last Name:</label>
                        <input required type="text" name="secondLastName" id="secondLastName" class="uppercase">
                    </div>
                    <div>
                        <label for="firstName">First Name:</label>
                        <input required type="text" name="firstName" id="firstName" class="uppercase">
                    </div>
                    <div>
                        <label for="middleName">Middle Name(s):</label>
                        <input required type="text" name="middleName" id="middleName" class="uppercase">
                    </div>
                    <div>
                        <label for="country">Country:</label>
                        <select required class="" name="country" id="country">
                            <option value="" selected disabled> -- Select One -- </option>
                            <option value="col">Colombia</option>
                            <option value="usa">United States</option>
                        </select>
                    </div>
                    <div>
                        <label for="typeId">Type of ID:</label>
                        <select required name="typeId" id="tipeId">
                            <option value="" selected disabled> -- Select One -- </option>
                            <option value="nationalId">National ID</option>
                            <option value="foreignerId">Foreigner ID</option>
                            <option value="passport">Passport</option>
                        </select>
                    </div>
                    <div>
                        <label for="doc">ID number:</label>
                        <input required type="text" name="doc" id="doc">
                    </div>
                    <div>
                        <label for="startDate">Start date:</label>
                        <input required type="date" name="startDate" id="startDate">
                    </div>
                    <div>
                        <label for="area">Area:</label>
                        <select required name="area" id="area">
                            <option value="" selected disabled> -- Select One -- </option>
                            <option value="administration">Administration</option>
                            <option value="finance">Finance</option>
                            <option value="operations">Operations</option>
                            <option value="hResources">Human Resources</option>
                        </select>   
                    </div>
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1">Send</button>          
                    <a href="/show">
                        <h4 class="text-xl text-right text-blue-300 font-bold">Show Employees -></h4>
                    </a>
                </form>
            </section>

            <div class="alert"> 
                <p class="error text-red-300"></p>
                <p class="success text-green-700"></p>

            </div>
            <div>

            </div>
        </main>
    </body>

    <script>
        const today = new Date();
        const lastMonth = new Date();
        lastMonth.setMonth(today.getMonth() - 1); 
        
        const todayString = today.toISOString().split('T')[0]; 
        const lastMonthString = lastMonth.toISOString().split('T')[0]; 

        document.getElementById('startDate').setAttribute('min', lastMonthString);
        document.getElementById('startDate').setAttribute('max', todayString);

        const inputUppercase = document.querySelectorAll('.uppercase');

        inputUppercase.forEach(input => {
            input.addEventListener('input', () => {
                input.value = input.value.toUpperCase();
            });
        });

        let alert = document.querySelector('.alert');
        let error = document.querySelector('.error');
        let success = document.querySelector('.success');

        function showAlert(message, isError = false) {
            if (isError) {
                error.textContent = message;
                error.classList.remove('hidden');
                success.classList.add('hidden');
            } else {
                success.textContent = message;
                success.classList.remove('hidden');
                error.classList.add('hidden');
            }
            alert.classList.remove('hidden');
            setTimeout(() => {
                alert.classList.add('hidden');
            }, 5000);
        }

        document.getElementById('registerForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(event.target);

            fetch('api/register', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message);
                    event.target.reset();
                } else {
                    if (data.errors) {
                        let errorMessage = '\n';
                        for (let field in data.errors) {
                            errorMessage += `${data.errors[field].join(', ')}\n`;
                        }
                        showAlert(errorMessage, true);
                    } else {
                        showAlert(data.message || 'An error occurred.', true);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Something went wrong. Please try again.', true);
            });
        });
    </script>
</html>