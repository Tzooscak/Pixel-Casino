<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/Js/Painter.js"></script>
    <title>Profile Creator</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #1a1a1a, #0d0d0d);
            color: #fff;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 800px;
            width: 100%;
        }

        h2 {
            color: #ffd700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            animation: glow 2s ease-in-out infinite;
        }

        #myCanvas {
            background: #2c3e50;
            border: 3px solid rgba(255, 215, 0, 0.3);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            margin-bottom: 30px;
            max-width: 100%;
            cursor: crosshair;
            transition: border-color 0.3s ease;
        }

        #myCanvas:hover {
            border-color: rgba(255, 215, 0, 0.6);
        }

        .buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            background: linear-gradient(145deg, #f39c12, #d35400);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
            min-width: 200px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(243, 156, 18, 0.4);
            background: linear-gradient(145deg, #e67e22, #d35400);
        }

        @keyframes glow {
            0% { text-shadow: 0 0 10px rgba(255, 215, 0, 0.5); }
            50% { text-shadow: 0 0 20px rgba(255, 215, 0, 0.7); }
            100% { text-shadow: 0 0 10px rgba(255, 215, 0, 0.5); }
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 20px;
            }

            #myCanvas {
                width: 100%;
                height: auto;
            }

            .buttons {
                flex-direction: column;
                gap: 10px;
            }

            button {
                width: 100%;
                padding: 12px 20px;
                font-size: 1rem;
            }

            h2 {
                font-size: 2rem;
            }
        }

        /* Add loading animation */
        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                rgba(243, 156, 18, 0), 
                rgba(243, 156, 18, 0.2), 
                rgba(243, 156, 18, 0));
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Add save animation */
        .save-flash {
            animation: saveFlash 0.5s ease;
        }

        @keyframes saveFlash {
            0% { background: rgba(46, 204, 113, 0.3); }
            100% { background: transparent; }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>🎨 Profile Creator</h2>
        <canvas id="myCanvas" width="600" height="300"></canvas>
        <div class="buttons">
            <button id="saveProfile">💾 Save Profile</button>
            <button id="clearCanvas">🧹 Clear Canvas</button>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            app.init();

            const saveButton = document.getElementById('saveProfile');
            saveButton.addEventListener('click', () => {
                const canvas = document.getElementById('myCanvas');
                canvas.classList.add('save-flash');
                setTimeout(() => {
                    canvas.classList.remove('save-flash');
                }, 500);
            });
        });
    </script>
</body>
</html>