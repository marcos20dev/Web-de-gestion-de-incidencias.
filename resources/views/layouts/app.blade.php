<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Incidex')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        surface: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .neon-glow {
            box-shadow: 0 0 10px rgba(74, 222, 128, 0.3),
            0 0 20px rgba(74, 222, 128, 0.2);
        }

        .sidebar-item.active {
            background: rgba(34, 197, 94, 0.1);
            border-left: 4px solid #22c55e;
            color: #22c55e;
        }

        .sidebar-item.active i {
            color: #22c55e;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pendiente {
            background-color: rgba(251, 191, 36, 0.1);
            color: #f59e0b;
        }

        .status-proceso {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .status-resuelto {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-cerrado {
            background-color: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .priority-baja {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .priority-media {
            background-color: rgba(251, 191, 36, 0.1);
            color: #f59e0b;
        }

        .priority-alta {
            background-color: rgba(249, 115, 22, 0.1);
            color: #f97316;
        }

        .priority-critica {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
    </style>
</head>
<body class="min-h-screen">
@yield('content')

@yield('scripts')
</body>
</html>
