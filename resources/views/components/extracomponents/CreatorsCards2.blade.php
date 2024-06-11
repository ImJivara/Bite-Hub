
<style>
    .cardcreator {
  position: relative;
  width: 290px;
  height: 354px;
  background-color: #000;
  display: flex;
  flex-direction: column;
  justify-content: end;
  padding: 12px;
  gap: 12px;
  border-radius: 8px;
  cursor: pointer;
  color: white;
}

.cardcreator::before {
  content: '';
  position: absolute;
  inset: 0;
  left: -5px;
  margin: auto;
  width: 300px;
  height: 364px;
  border-radius: 10px;
  background: linear-gradient(-45deg, #e81cff 0%, #40c9ff 100% );
  z-index: -10;
  pointer-events: none;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cardcreator::after {
  content: "";
  z-index: -1;
  position: absolute;
  inset: 0;
  background: linear-gradient(-45deg, #fc00ff 0%, #00dbde 100% );
  transform: translate3d(0, 0, 0) scale(0.95);
  filter: blur(20px);
}

.headingg {
  font-size: 2rem;
  text-transform: capitalize;
  font-weight: 700;
}

.cardcreator p:not(.headingg) {
  font-size: 1.5rem;
}

.cardcreator .thir {
  color: #F60000;
  font-weight: 600;
}

.cardcreator:hover::after {
  filter: blur(30px);
}

.cardcreator:hover::before {
  transform: rotate(-90deg) scaleX(1.34) scaleY(0.77);
}
.profile-container {
    position: relative;
    width: 125px;
    height: 135px;
    border-radius: 50%;
    overflow: hidden;
    
    
    
    
}

.profile-image {
    width: 100%;
    height: 100%;
    
    object-fit: cover;
}

</style>
@props(['name'])
<div class="cardcreator">
  <div class="profile-container ml-16 ">
    <img class="profile-image" src="{{asset('imgs/3.jpg')}}" alt="">
  </div>
  <p class="headingg">{{$name}}</p>
  <p class="sec">Faculty Of Technology</p>
  <p class="thir">Business Computer</p>
  <x-extracomponents.tooltip/>
</div>