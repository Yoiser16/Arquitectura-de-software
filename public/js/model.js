const Model = {
    difficulty: 1,
    player: null,
    enemies: [],
    powerups: [],
    maxEnemies: 3,
    score: 0,
    lossStreak: 0,
    winStreak: 0,
    enemySpeed: 1,  // velocidad inicial de enemigos

    initGame: function () {
        this.player = { x: 400, y: 300, r: 15, speed: 2, lives: 3, shield: false };
        this.enemies = [];
        this.powerups = [];
        this.maxEnemies = 3;
        this.score = 0;
        this.lossStreak = 0;
        this.winStreak = 0;
        this.enemySpeed = 1;
    },

    resetGame: function () {
        this.initGame();
    }
};
