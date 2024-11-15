const app = function () {
    let canvas, ctx;
    let mouseX = 0, mouseY = 0;
    let isDrawing = false;
    let currentColor = "#4ebca9"; //deff color

    function init() {
        canvas = document.getElementById('myCanvas');
        if (!canvas) {
            console.error("Canvas element not found");
            return;
        }
        ctx = canvas.getContext("2d");
        if (!ctx) {
            console.error("2D context not available");
            return;
        }

        ctx.fillStyle = "#ffffff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        canvas.addEventListener("mousedown", startDrawing, false);
        canvas.addEventListener("mouseup", stopDrawing, false);
        canvas.addEventListener("mousemove", draw, false);

        setupColorPalette();


        //clear the canvas
        document.getElementById('clearCanvas').addEventListener('click', () => {
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        //save the drawing as a PNG file
        document.getElementById('saveProfile').addEventListener('click', () => {
            const link = document.createElement('a');
            link.download = 'profile_drawing.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
        
    }

    function startDrawing(e) {
        isDrawing = true; 
        const rect = canvas.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;
        ctx.beginPath();
        ctx.moveTo(mouseX, mouseY);
    }

    function stopDrawing() {
        isDrawing = false;
        ctx.closePath();
    }

    function draw(e) {
        if (!isDrawing) return;
        const rect = canvas.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;

        ctx.lineTo(mouseX, mouseY);
        ctx.strokeStyle = currentColor;
        ctx.lineWidth = 2;
        ctx.stroke();
    }

    function setupColorPalette() {
        const colors = document.querySelectorAll(".color");
        colors.forEach(colorElement => {
            colorElement.addEventListener("click", function () {
                currentColor = this.getAttribute("data-color"); //ne color
            });
        });
    }

    
    

    return {
        init: init
    };
}();
