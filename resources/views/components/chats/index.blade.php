<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
    <div>
        <div class="w-full h-32" style="background-color: #449388"></div>
        <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
        <div class="container mx-auto" style="margin-top: -128px;">
            <div class="py-6 h-screen">
                <div class="flex border border-grey rounded shadow-lg h-full">

                 {{$slot}}  

                </div>
             
            </div>
        </div>
    </div>
</body>

</html>

