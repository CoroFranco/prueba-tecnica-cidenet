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
    <main class="text-white py-6 px-20 bg-white bg-opacity-10 p-8 rounded-2xl shadow-2xl shadow-[#92929294] backdrop-blur-xl border border-blue-300/15">
        <img class="w-[300px] cursor-pointer" fetchpriority="high" width="1255" height="276" src="https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color.png" class="attachment-full size-full wp-image-401" alt="" srcset="https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color.png 1255w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-300x66.png 300w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-1024x225.png 1024w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-768x169.png 768w, https://cidenet.com.co/wp-content/uploads/2022/09/cropped-Logo-cidenet-2022-full-color-18x4.png 18w" sizes="(max-width: 1255px) 100vw, 1255px">
        <section class="flex flex-col">
            <h2 class="text-center text-xl font-medium text-blue-300">Register Employee</h2>
            <form class="flex flex-col" action="">
                <label for="firstLastName">First Last Name</label>
                <input type="text" name="firstLastName" id="firstLastName">
                <label for="secondLastName">Second Last Name</label>
                <input type="text" name="secondLastName" id="secondLastName">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName">
                <label for="middleName">Middle Name(s)</label>
                <input type="text" name="middleName" id="middleName">
                <label for="country">Country</label>
                <select class="text-black" name="country" id="country">
                    <option value="" selected disabled> -- Select One -- </option>
                    <option value="col">Colombia</option>
                    <option value="usa">United States</option>
                </select>
                <label for="idType">Type of ID</label>
                <select name="typeId" id="tipeId">
                    <option value="" selected disabled> -- Select One -- </option>
                    <option value="nationalId">National ID</option>
                    <option value="foreignerId">Foreigner ID</option>
                    <option value="passport">Passport</option>
                </select>
                <label for="id">ID number</label>
                <input type="text">
                <label for="startDate">Start date</label>
                <input type="date" name="startDate">
                <label for="area">Area</label>
                <select name="area" id="area">
                    <option value="" selected disabled> -- Select One -- </option>
                    <option value="administration">Administration</option>
                    <option value="finance">Finance</option>
                    <option value="operations">Operations</option>
                    <option value="hResources">Human Resources</option>
                </select>   
                <button>Send</button>          
            </form>
        </section>
    </main>
</body>
</html>