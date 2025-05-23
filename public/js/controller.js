const Controller = {
    keys: {},
    intervalId: null,
    keyDownHandler: null,
    keyUpHandler: null,
    paused: false,
    pauseMenuOptions: ["Reanudar", "Seleccionar dificultad", "Salir"],
    pauseMenuIndex: 0,

    selectDifficulty: function(level) {
        Model.difficulty = level;
        Model.initGame();
        this.start();
    },

    start: function() {
        if (this.intervalId !== null) return;

        View.init();

        this.keyDownHandler = (e) => {
            this.keys[e.key] = true;

            if (!this.paused) {
                if (e.key.toLowerCase() === 'p') {
                    this.togglePause();
                }
            } else {
                // Navegar menú pausa
                if (e.key === "ArrowUp") {
                    this.pauseMenuIndex = (this.pauseMenuIndex - 1 + this.pauseMenuOptions.length) % this.pauseMenuOptions.length;
                    View.drawPauseMenu(this.pauseMenuOptions, this.pauseMenuIndex);
                } else if (e.key === "ArrowDown") {
                    this.pauseMenuIndex = (this.pauseMenuIndex + 1) % this.pauseMenuOptions.length;
                    View.drawPauseMenu(this.pauseMenuOptions, this.pauseMenuIndex);
                } else if (e.key === "Enter") {
                    this.handlePauseMenuSelection();
                } else if (e.key.toLowerCase() === 'p') {
                    // También permitir reanudar con 'p'
                    this.togglePause();
                }
            }
        };

        this.keyUpHandler = (e) => this.keys[e.key] = false;

        window.addEventListener("keydown", this.keyDownHandler);
        window.addEventListener("keyup", this.keyUpHandler);

        this.intervalId = setInterval(this.loop.bind(this), 16);
    },

    stop: function() {
        clearInterval(this.intervalId);
        this.intervalId = null;
        this.keys = {};

        if (this.keyDownHandler) window.removeEventListener("keydown", this.keyDownHandler);
        if (this.keyUpHandler) window.removeEventListener("keyup", this.keyUpHandler);
    },

    reset: function() {
        this.stop();
        Model.resetGame();
        this.start();
    },

    togglePause: function() {
        this.paused = !this.paused;
        if (this.paused) {
            this.pauseMenuIndex = 0; // Reset menú pausa
            console.log("Juego pausado");
            View.drawPauseMenu(this.pauseMenuOptions, this.pauseMenuIndex);
        } else {
            console.log("Juego reanudado");
            View.draw();
        }
    },

    handlePauseMenuSelection: function() {
        const option = this.pauseMenuOptions[this.pauseMenuIndex];
        if (option === "Reanudar") {
            this.togglePause();
        } else if (option === "Seleccionar dificultad") {
            this.togglePause();
            // Puedes crear una función para mostrar menú dificultad
            // Por simplicidad aquí se reinicia el juego con dificultad media
            this.selectDifficulty("medium");
        } else if (option === "Salir") {
            window.location.href = "usuario.php";
        }
    },

    loop: function() {
        if (this.paused) {
            // El dibujo del menú pausa se hace en el keyDownHandler, aquí no hace falta
            return;
        }

        this.movePlayer();
        this.moveEnemies();
        this.checkCollisions();
        this.spawnEnemies();
        this.spawnPowerups();
        this.adaptDifficulty();
        View.draw();
    },

    movePlayer: function() {
        const p = Model.player;
        if (this.keys["ArrowUp"]) p.y -= p.speed;
        if (this.keys["ArrowDown"]) p.y += p.speed;
        if (this.keys["ArrowLeft"]) p.x -= p.speed;
        if (this.keys["ArrowRight"]) p.x += p.speed;
        p.x = Math.max(p.r, Math.min(800 - p.r, p.x));
        p.y = Math.max(p.r, Math.min(600 - p.r, p.y));
    },

    moveEnemies: function() {
        const speed = Model.enemySpeed || 1;
        const dispersionRadius = 50;

        for (const enemy of Model.enemies) {
            // Calculamos un punto disperso alrededor del jugador
            const angle = Math.random() * 2 * Math.PI;
            const offsetX = Math.cos(angle) * Math.random() * dispersionRadius;
            const offsetY = Math.sin(angle) * Math.random() * dispersionRadius;

            const targetX = Model.player.x + offsetX;
            const targetY = Model.player.y + offsetY;

            let dx = targetX - enemy.x;
            let dy = targetY - enemy.y;

            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist > 1) {
                dx /= dist;
                dy /= dist;
            }

            enemy.x += dx * speed;
            enemy.y += dy * speed;
        }
    },

    checkCollisions: function() {
        for (let i = 0; i < Model.enemies.length; i++) {
            const e = Model.enemies[i];
            const d = Math.hypot(e.x - Model.player.x, e.y - Model.player.y);
            if (d < Model.player.r + 10) {
                if (Model.player.shield) {
                    Model.player.shield = false;
                } else {
                    Model.player.lives--;
                    Model.lossStreak++;
                    Model.winStreak = 0;

                    if (Model.player.lives <= 0) {
                        this.stop();

                        fetch("guardar_puntaje.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({
                                nombre: nombreJugador,
                                puntaje: Model.score
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                alert("¡Puntaje guardado exitosamente!");
                            } else {
                                alert("Error al guardar puntaje: " + data.error);
                            }
                        })
                        .catch(error => {
                            console.error("Error en la solicitud:", error);
                            alert("Hubo un error al guardar tu puntaje.");
                        })
                        .finally(() => this.reset());

                        return;
                    }
                }

                Model.enemies.splice(i, 1);
                i--;
            }
        }

        for (let i = 0; i < Model.powerups.length; i++) {
            const p = Model.powerups[i];
            const d = Math.hypot(p.x - Model.player.x, p.y - Model.player.y);
            if (d < Model.player.r + 8) {
                if (p.type === "speed") {
                    Model.player.speed = 4;
                    setTimeout(() => Model.player.speed = 2, 5000);
                } else if (p.type === "shield") {
                    Model.player.shield = true;
                } else if (p.type === "life") {
                    Model.player.lives++;
                }
                Model.powerups.splice(i, 1);
                i--;
            }
        }
    },

    spawnEnemies: function() {
        if (Model.enemies.length < Model.maxEnemies && Math.random() < 0.02) {
            const x = Math.random() * 800;
            const y = Math.random() * 600;
            Model.enemies.push({ x, y });
        }
    },

    spawnPowerups: function() {
        if (Model.powerups.length < 3 && Math.random() < 0.01) {
            const types = ["speed", "shield", "life"];
            const type = types[Math.floor(Math.random() * types.length)];
            Model.powerups.push({
                x: Math.random() * 800,
                y: Math.random() * 600,
                type
            });
        }
    },

    adaptDifficulty: function() {
        if (Model.lossStreak >= 3 && Model.maxEnemies > 1) {
            Model.maxEnemies--;
            Model.lossStreak = 0;
        }
        else if (Model.winStreak >= 5 && Model.maxEnemies < 10) {
            Model.maxEnemies++;
            Model.winStreak = 0;
        }

        Model.enemySpeed = 0.5 + 0.1 * Model.maxEnemies;

        Model.score++;

        if (Model.score % 100 === 0) {
            Model.winStreak++;
        }
    }
};
