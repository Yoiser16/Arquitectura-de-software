const View = {
    canvas: document.getElementById("gameCanvas"),
    ctx: null,
    pauseMenuOptions: ["Reanudar", "Seleccionar dificultad", "Salir"],
    pauseMenuSelected: 0,

    init: function () {
        this.ctx = this.canvas.getContext("2d");
    },

    draw: function () {
        const ctx = this.ctx;
        ctx.clearRect(0, 0, 800, 600);

        // Jugador
        ctx.beginPath();
        ctx.arc(Model.player.x, Model.player.y, Model.player.r, 0, 2 * Math.PI);
        ctx.fillStyle = Model.player.shield ? "cyan" : "white";
        ctx.fill();

        // Enemigos con color según dificultad (maxEnemies)
        for (const enemy of Model.enemies) {
            ctx.beginPath();
            ctx.arc(enemy.x, enemy.y, 10, 0, 2 * Math.PI);

            if (Model.maxEnemies <= 3) {
                ctx.fillStyle = "green";  // fácil
            } else if (Model.maxEnemies <= 6) {
                ctx.fillStyle = "orange"; // medio
            } else {
                ctx.fillStyle = "red";    // difícil
            }

            ctx.fill();
        }

        // PowerUps con formas diferentes
        for (const pu of Model.powerups) {
            switch (pu.type) {
                case "speed":
                    this.drawTriangle(pu.x, pu.y, 16, "lime");
                    break;
                case "shield":
                    this.drawSquare(pu.x, pu.y, 16, "cyan");
                    break;
                case "life":
                    this.drawStar(pu.x, pu.y, 8, 5, 0.5, "yellow");
                    break;
            }
        }

        // Texto
        ctx.fillStyle = "white";
        ctx.font = "16px Arial";
        ctx.fillText("Vidas: " + Model.player.lives + " | Puntos: " + Model.score, 10, 20);

        // Dificultad (opcional)
        ctx.fillText(`Enemigos: ${Model.maxEnemies} | Velocidad: ${Model.enemySpeed ? Model.enemySpeed.toFixed(2) : 1}`, 10, 40);
    },

    drawPaused: function () {
        const ctx = this.ctx;
        ctx.clearRect(0, 0, 800, 600);

        // Fondo semitransparente
        ctx.fillStyle = "rgba(0, 0, 0, 0.7)";
        ctx.fillRect(0, 0, 800, 600);

        ctx.fillStyle = "white";
        ctx.textAlign = "center";

        // Título PAUSA
        ctx.font = "48px Arial";
        ctx.fillText("PAUSA", 400, 150);

        // Menú de opciones
        ctx.font = "28px Arial";
        this.pauseMenuOptions.forEach((option, index) => {
            ctx.fillStyle = (index === this.pauseMenuSelected) ? "yellow" : "white";
            ctx.fillText(option, 400, 250 + index * 40);
        });

        ctx.font = "16px Arial";
        ctx.fillStyle = "white";
        ctx.fillText("Usa ↑ ↓ para navegar, Enter para seleccionar", 400, 400);

        ctx.textAlign = "start";
    },

    drawTriangle: function (x, y, size, color) {
        const ctx = this.ctx;
        ctx.fillStyle = color;
        ctx.beginPath();
        ctx.moveTo(x, y - size / 2);
        ctx.lineTo(x - size / 2, y + size / 2);
        ctx.lineTo(x + size / 2, y + size / 2);
        ctx.closePath();
        ctx.fill();
    },

    drawSquare: function (x, y, size, color) {
        const ctx = this.ctx;
        ctx.fillStyle = color;
        ctx.fillRect(x - size / 2, y - size / 2, size, size);
    },

    drawStar: function (cx, cy, outerRadius, points, innerRadiusRatio, color) {
        const ctx = this.ctx;
        const innerRadius = outerRadius * innerRadiusRatio;
        const step = Math.PI / points;

        ctx.fillStyle = color;
        ctx.beginPath();

        for (let i = 0; i < 2 * points; i++) {
            const r = i % 2 === 0 ? outerRadius : innerRadius;
            const angle = i * step - Math.PI / 2;
            const x = cx + r * Math.cos(angle);
            const y = cy + r * Math.sin(angle);
            if (i === 0) {
                ctx.moveTo(x, y);
            } else {
                ctx.lineTo(x, y);
            }
        }
        ctx.closePath();
        ctx.fill();
    },

    // Resetea la selección del menú de pausa a la primera opción
    resetPauseMenuSelection: function () {
        this.pauseMenuSelected = 0;
    }
};
