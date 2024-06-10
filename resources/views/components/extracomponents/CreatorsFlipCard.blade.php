<style>
.flip-card {
  background-color: transparent;
  width: 290px;
  height: 354px;
  perspective: 1000px;
  font-family: sans-serif;
}

.title {
  font-size: 1.5em;
  font-weight: 900;
  text-align: center;
  margin: 0;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  box-shadow: 0 8px 14px 0 rgba(0,0,0,0.2);
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  border: 1px solid coral;
  border-radius: 1rem;
}

.flip-card-front {
  background: linear-gradient(120deg, bisque 60%, rgb(128, 21, 21) 88%,
     rgb(128, 21, 21) 40%, rgba(128, 21, 21) 48%);
  color: black;
}

.flip-card-back {
  background: linear-gradient(120deg, rgb(255, 174, 145) 30%, coral 88%,
     bisque 40%, rgb(255, 185, 160) 78%);
  color: white;
  transform: rotateY(180deg);
}
</style>
<div class="flip-card">
    <div class="flip-card-inner">
        <div class="flip-card-front">
            <p class="title">Ahmad Afara</p>
            <p>Hover Me</p>
        </div>
        <div class="flip-card-back">
            <p class="title">3rd Year Business Computer</p>
            <div class="profile-container mt-4 w-40 h-40 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('imgs/3.jpg') }}" alt="Profile Image" class="w-full h-full object-cover">
                </div>
        </div>
    </div>
</div>
<!-- <body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="flip-card w-64 h-80 bg-gray-200 p-4 rounded-lg shadow-lg">
        <div class="flip-card-inner">
            <div class="flip-card-front flex flex-col justify-center items-center p-4 bg-white rounded-lg shadow-md">
                <p class="title text-xl font-bold mb-2">Ahmad Afara</p>
                <p class="text-gray-700">Hover Me</p>
            </div>
            <div class="flip-card-back flex flex-col justify-center items-center p-4 bg-gray-200 rounded-lg shadow-md">
                <p class="title text-lg font-semibold mb-2">3rd Year Business Computer</p>
                <div class="profile-container mt-4 w-40 h-40 rounded-full overflow-hidden shadow-md">
                    <img src="https://via.placeholder.com/150" alt="Profile Image" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div> -->

</body>