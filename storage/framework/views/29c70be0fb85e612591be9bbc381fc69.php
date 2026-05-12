<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Error'); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #F5F3FF 0%, #FDF2F8 50%, #ECFEFF 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-container {
            text-align: center;
            padding: 2rem;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .error-title {
            font-size: 2rem;
            font-weight: 600;
            color: #374151;
            margin-top: 1rem;
        }
        .error-message {
            font-size: 1rem;
            color: #6B7280;
            margin-top: 0.5rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%);
            color: white;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 500;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.25);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code"><?php echo e($exception->getStatusCode()); ?></div>
        <h1 class="error-title"><?php echo e($title ?? 'Something went wrong'); ?></h1>
        <p class="error-message"><?php echo e($message ?? 'Page Expired. Please try again.'); ?></p>
        <a href="/" class="btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Go Home
        </a>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/errors/419.blade.php ENDPATH**/ ?>