
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Items System</title>
</head>
<body class="bg-gray-50 min-h-screen p-4 md:p-8">
    <livewire:item-view/>
</body>
<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        var message = document.getElementById('message');
        
        if (successMessage) {
            successMessage.style.transition = 'opacity 0.5s ease-in-out';
            successMessage.style.opacity = '0';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 500);
        }
        
        if (message) {
            message.style.transition = 'opacity 0.5s ease-in-out';
            message.style.opacity = '0';
            setTimeout(() => {
                message.style.display = 'none';
            }, 500);
        }
    }, 6000);
</script>
</html>