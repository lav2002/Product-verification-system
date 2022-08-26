
class Vector {
    constructor(x, y) {
      this.x = x;
      this.y = y;
    }
  
    add(v) {
      return new Vector(this.x + v.x, this.y + v.y);
    }
  
    addTo(v) {
      this.x += v.x;
      this.y += v.y;
    }
  
    sub(v) {
      return new Vector(this.x - v.x, this.y - v.y);
    }
  
    subFrom(v) {
      this.x -= v.x;
      this.y -= v.y;
    }
  
    mult(n) {
      return new Vector(this.x * n, this.y * n);
    }
  
    multTo(n) {
      this.x *= n;
      this.y *= n;
    }
  
    div(n) {
      return new Vector(this.x / n, this.y / n);
    }
  
    divTo(n) {
      this.x /= n;
      this.y /= n;
    }
  
    setAngle(angle) {
      var length = this.getLength();
      this.x = Math.cos(angle) * length;
      this.y = Math.sin(angle) * length;
    }
  
    setLength(length) {
      var angle = this.getAngle();
      this.x = Math.cos(angle) * length;
      this.y = Math.sin(angle) * length;
    }
  
    getAngle() {
      return Math.atan2(this.y, this.x);
    }
  
    getLength() {
      return Math.sqrt(this.x * this.x + this.y * this.y);
    }
  
    getLengthSq() {
      return this.x * this.x + this.y * this.y;
    }
  
    distanceTo(v) {
      return this.sub(v).getLength();
    }
  
    distanceToSq(v) {
      return this.sub(v).getLengthSq();
    }
  
    manhattanDistanceTo(v) {
      return Math.abs(v.x - this.x) + Math.abs(v.y - this.y);
    }
  
    copy() {
      return new Vector(this.x, this.y);
    }
  
    rotate(angle) {
      return new Vector(
        this.x * Math.cos(angle) - this.y * Math.sin(angle),
        this.x * Math.sin(angle) + this.y * Math.cos(angle)
      );
    }
  }
  
  
  class BlackHole {
    constructor(x, y) {
      this.pos = new Vector(x, y);
    }
  
    applyGravityOn(thing) {
      let dist = thing.pos.sub(this.pos);
      let length = dist.getLength();
      let g = 2000 / (length * length);
  
      // We keep the angle of the distance
      dist.setLength(g);
      thing.vel.subFrom(dist);
    }
  }
  
  class Particle {
    constructor(x, y) {
      this.pos = new Vector(x, y);
      this.vel = new Vector(0, 0);
    }
  
    move(force) {
      if (this.vel.getLength() > 4) {
        this.vel.setLength(4);
      }
      this.pos.addTo(this.vel);
    }
  
    draw() {
      let r = this.pos.sub(new Vector(w / 2, h / 2)).getLength() / 60;
      ctx.beginPath();
      ctx.arc(this.pos.x, this.pos.y, r, 0, Math.PI * 2);
      ctx.fill();
    }
  }
  
  let canvas;
  let ctx;
  let w, h;
  let particles;
  let blackHole;
  
  function setup() {
    canvas = document.querySelector("#canvas");
    ctx = canvas.getContext("2d");
    reset();
    setupParticles();
    blackHole = new BlackHole(w / 2, h / 2);
    //window.addEventListener("resize", reset); // Glenn Bacon change to call setup
    window.addEventListener("resize", setup);
  }
  
  function setupParticles() {
    particles = [];
  
    for (let i = 0; i < 10; i++) {
      let p = new Particle(Math.random() * w, Math.random() * h);
      particles.push(p);
    }
  }
  
  function reset() {
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
  }
  
  function draw() {
    requestAnimationFrame(draw);
    //ctx.fillStyle = "black";
    // ctx.fillRect(0, 0, w, h);
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Glenn Bacon clear canvas no background
    ctx.fillStyle = "white";
    particles.forEach(p => {
      blackHole.applyGravityOn(p);
      p.draw();
      p.move();
    });
    let newParticle = new Particle(random(-50, w + 50), random(-50, h + 50));
    particles.push(newParticle);
    particles = particles.filter(p => blackHole.pos.sub(p.pos).getLength() > 2);
  }
  
  function random(min, max) {
    if (max === undefined) {
      max = min;
      min = 0;
    }
    return Math.floor(Math.random() * (max - min)) + min;
  }
  
  setup();
  draw();