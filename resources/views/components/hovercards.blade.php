<style>
    .cards {
  display: flex;
  flex-direction: row;
  gap: 15px;
}

.cards .red {
  background-color: #007e9e;
}

.cards .blue {
  background-color: #0062ff;
}

.cards .green {
  background-color: #18cd5e;
}

.cards .card {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
  height: 200px;
  width: 300px;
  border-radius: 10px;
  color: white;
  cursor: pointer;
  transition: 400ms;
}

.cards .card p.tip {
  font-size: 3em;
  font-weight: 700;
}

.cards .card p.second-text {
  font-size: 1em;
}

.cards .card:hover {
  transform: scale(1.2, 1.2);
}

.cards:hover > .card:not(:hover) {
  filter: blur(10px);
  transform: scale(0.9, 0.9);
}
.lock-overlay {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-radius: 10px;
}

.lock-overlay {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    
    justify-content: center;
    align-items: center;
    border-radius: 10px;
}

.lock-overlay i {
    font-size: 48px;
}

.card.green:hover .lock-overlay {
    display: flex;
}
</style>
<div class="cards">

    <div class="card blue" onclick="window.location.href='/Recipes'">
        <p class="tip">Explore Recipes</p>
        <p class="second-text">Visit Bite-Hub</p>
    </div>

    <div class="card green" @if(!Auth::user()) onclick="return false;" @else onclick="window.location.href='/HealthTools'" @endif>
        <p class="tip">Health <br>Tools</p>
        <p class="second-text">Try Our Health Tools</p>
        @if(!Auth::user())
            <div class="lock-overlay">
                <i class="fas fa-lock"></i>
                <span class="lock-text">Sign in to access</span>
            </div>
        @endif
    </div>
</div>

