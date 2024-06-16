
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<div class="flex items-center justify-center ">
    <div class="container mx-auto mt-8">
        <div class="max-w-lg mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 bmi-card">
            <h2 class="text-2xl font-bold mb-4 text-center text-black">BMI Calculator</h2>
            <form id="bmi-form" class="space-y-4">
                <div>
                    <label for="height" class="block text-lg font-medium">Height (cm):</label>
                    <input type="number" id="height" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label for="weight" class="block text-lg font-medium">Weight (kg):</label>
                    <input type="number" id="weight" class="w-full p-2 border rounded" required>
                </div>
                <div class="text-center">
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out">Calculate BMI</button>
                </div>
            </form>
            <div id="bmi-result" class="mt-4 text-center text-xl font-semibold text-blue-700"></div>
        </div>
</div>

    <script>
        document.getElementById('bmi-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const height = parseFloat(document.getElementById('height').value) / 100;
            const weight = parseFloat(document.getElementById('weight').value);
            const bmi = (weight / (height * height)).toFixed(2);
            let message = `Your BMI is ${bmi}. `;

            if (bmi < 18.5) {
                message += "You are underweight.";
            } else if (bmi >= 18.5 && bmi < 24.9) {
                message += "You have a normal weight.";
            } else if (bmi >= 25 && bmi < 29.9) {
                message += "You are overweight.";
            } else {
                message += "You are obese.";
            }

            document.getElementById('bmi-result').innerText = message;
        });
    </script>
</div>

