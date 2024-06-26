<style>
/* Innovative Banner */
.card {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background: #e8e8e8
  border-radius: 20px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  overflow: hidden;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  max-width: 400px;
  height: auto;
  transition: all ease-in-out 0.5s;
}
.card::before,
.card::after {
  content: "";
  position: absolute;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  z-index: -2;
}
.card::before {
  top: -25px;
  left: -25px;
  background: radial-gradient(circle, #875c98, #4a236a);
  filter: blur(20px);
  opacity: 0.8;
  animation: glowBall1 5s infinite ease-in-out;
}

.card::after {
  bottom: -25px;
  right: -25px;
  background: radial-gradient(circle, #4a236a, #875c98);
  filter: blur(20px);
  opacity: 0.8;
  animation: glowBall2 7s infinite ease-in-out;
}
.image {
  width: 70%;
  height: auto;
  border-radius: 20px 20px 0 0; /* Adjust rounded corners */
  transition: transform 0.3s ease;
  z-index: 9; /* Ensure the image is above the balls */
  display: block;
  margin: 0 auto; /* Center the image horizontally */
}
.image:hover {
  transform: scale(1.05);
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.4);
}
.heading {
  position: relative;
  font-size: 18px;
  font-weight: bold;
  color: #fff;
  text-align: center;
  padding: 10px;
  margin: 0;
  z-index: 6;
  transition: transform 0.3s ease;
  font-family: "Poppins", sans-serif;
}
.heading,
.icons {
  position: relative;
  transition: transform 0.5s ease-out;
}
.image:hover + .card .heading,
.image:hover + .card .icons {
  transform: translateY(-15px);
}
.icons a {
  opacity: 0.7;
  transition: opacity 0.3s ease;
}
.icons a:hover {
  opacity: 1;
}
.heading:hover {
  animation: bounce 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
}
@keyframes bounce {
  0%,
  20%,
  50%,
  80%,
  100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-20px);
  }
  60% {
    transform: translateY(-10px);
  }
}
.icons a svg {
  animation: pulse 1s infinite alternate;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.2);
  }
}
.heading:hover {
  animation: glow 1s infinite alternate;
}
@keyframes glow {
  0% {
    text-shadow: 0 0 2px rgba(255, 20, 147, 0.5),
      0 0 4px rgba(255, 20, 147, 0.5), 0 0 6px rgba(255, 20, 147, 0.5),
      0 0 8px rgba(255, 20, 147, 0.5), 0 0 10px rgba(255, 20, 147, 0.5),
      0 0 12px rgba(255, 20, 147, 0.5), 0 0 14px rgba(255, 20, 147, 0.5),
      0 0 16px rgba(255, 20, 147, 0.5);
    color: #fff;
  }
  50% {
    text-shadow: 0 0 4px rgba(255, 165, 0, 0.5), 0 0 6px rgba(255, 255, 0, 0.5),
      0 0 8px rgba(0, 255, 0, 0.5), 0 0 10px rgba(0, 127, 255, 0.5),
      0 0 12px rgba(46, 43, 95, 0.5), 0 0 14px rgba(139, 0, 255, 0.5),
      0 0 16px rgba(255, 20, 147, 0.5), 0 0 18px rgba(255, 165, 0, 0.5);
    color: #fff;
  }
  100% {
    text-shadow: 0 0 2px rgba(255, 20, 147, 0.5),
      0 0 4px rgba(255, 20, 147, 0.5), 0 0 6px rgba(255, 20, 147, 0.5),
      0 0 8px rgba(255, 20, 147, 0.5), 0 0 10px rgba(255, 20, 147, 0.5),
      0 0 12px rgba(255, 20, 147, 0.5), 0 0 14px rgba(255, 20, 147, 0.5),
      0 0 16px rgba(255, 20, 147, 0.5);
    color: #fff;
  }
}
.heading:hover {
  transform: translateY(5px);
}
.card ::before {
  position: fixed;
  content: "";
  box-shadow: 0 0 100px 40px rgba(255, 255, 255, 0.031372549);
  top: -10%;
  left: -100%;
  transform: rotate(-45deg);
  height: 60rem;
  transition: 0.7s all;
}
.card:hover ::before {
  filter: brightness(0.3);
  top: -100%;
  left: 200%;
}
.card:hover {
  border: 1px solid rgba(255, 255, 255, 0.2666666667);
  box-shadow: 0 7px 50px 10px rgba(0, 0, 0, 0.6666666667);
  transform: scale(1.015);
  filter: brightness(1.3);
  transform: translateY(-5px) rotate(1deg);
}
.heading:hover .icons {
  transform: translateY(10px);
}
.icons {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
  z-index: 2;
}
.icons a {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin: 0 10px;
  transition: transform 0.3s ease;
}
.icons a svg {
  border: none;
}
.icons a svg path {
  stroke: rgb(192, 192, 192);
}
.icons a:hover svg {
  transform: scale(1.1);
}
/* Glowing balls animations */
@keyframes glowBall1 {
  0% {
    background: linear-gradient(to right, #800080, #0000ff);
    opacity: 0.4;
    width: 100px;
    height: 100px;
  }

  50% {
    background: linear-gradient(to right, #00bfff, #32cd32);
    opacity: 0.5;
    width: 120px;
    height: 120px;
  }

  100% {
    background: linear-gradient(to right, #ff1493, #800080);
    opacity: 0.6;
    width: 150px;
    height: 150px;
  }
}

@keyframes glowBall2 {
  0% {
    background: linear-gradient(to right, #8a2be2, #4b0082);
    opacity: 0.6;
    width: 120px;
    height: 120px;
  }

  50% {
    background: linear-gradient(to right, #ffd700, #ff8c00);
    opacity: 0.2;
    width: 90px;
    height: 90px;
  }

  100% {
    background: linear-gradient(to right, #ff1493, #4a236a);
    opacity: 0.8;
    width: 100px;
    height: 100px;
  }
}

</style>






<div class="card">
  <img
    src="https://uiverse.io/build/_assets/astronaut-WTFWARES.png"
    alt=""
    class="image"
  />
  <div class="heading">We're on Social Media</div>
  <div class="icons">
    <a href="https://www.instagram.com/uiverse.io/" class="instagram">
      <svg
        width="24"
        height="25"
        viewBox="0 0 24 25"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M17.0459 7.5H17.0559M3.0459 12.5C3.0459 9.986 3.0459 8.73 3.3999 7.72C3.71249 6.82657 4.22237 6.01507 4.89167 5.34577C5.56096 4.67647 6.37247 4.16659 7.2659 3.854C8.2759 3.5 9.5329 3.5 12.0459 3.5C14.5599 3.5 15.8159 3.5 16.8269 3.854C17.7202 4.16648 18.5317 4.67621 19.201 5.34533C19.8702 6.01445 20.3802 6.82576 20.6929 7.719C21.0459 8.729 21.0459 9.986 21.0459 12.5C21.0459 15.014 21.0459 16.27 20.6929 17.28C20.3803 18.1734 19.8704 18.9849 19.2011 19.6542C18.5318 20.3235 17.7203 20.8334 16.8269 21.146C15.8169 21.5 14.5599 21.5 12.0469 21.5C9.5329 21.5 8.2759 21.5 7.2659 21.146C6.37268 20.8336 5.56131 20.324 4.89202 19.6551C4.22274 18.9862 3.71274 18.1751 3.3999 17.282C3.0459 16.272 3.0459 15.015 3.0459 12.501V12.5ZM15.8239 11.94C15.9033 12.4387 15.8829 12.9481 15.7641 13.4389C15.6453 13.9296 15.4304 14.392 15.1317 14.7991C14.833 15.2063 14.4566 15.5501 14.0242 15.8108C13.5917 16.0715 13.1119 16.2439 12.6124 16.318C12.1129 16.392 11.6037 16.3663 11.1142 16.2422C10.6248 16.1182 10.1648 15.8983 9.76082 15.5953C9.35688 15.2923 9.01703 14.9123 8.76095 14.4771C8.50486 14.0419 8.33762 13.5602 8.2689 13.06C8.13201 12.0635 8.39375 11.0533 8.99727 10.2487C9.6008 9.44407 10.4974 8.91002 11.4923 8.76252C12.4873 8.61503 13.5002 8.86599 14.3112 9.46091C15.1222 10.0558 15.6658 10.9467 15.8239 11.94Z"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        ></path>
      </svg>
    </a>
    <a href="https://twitter.com/uiverse_io" class="x">
      <svg
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M19.8003 3L13.5823 10.105L19.9583 19.106C20.3923 19.719 20.6083 20.025 20.5983 20.28C20.594 20.3896 20.5657 20.4969 20.5154 20.5943C20.4651 20.6917 20.3941 20.777 20.3073 20.844C20.1043 21 19.7293 21 18.9793 21H17.2903C16.8353 21 16.6083 21 16.4003 20.939C16.2168 20.8847 16.0454 20.7957 15.8953 20.677C15.7253 20.544 15.5943 20.358 15.3313 19.987L10.6813 13.421L4.64033 4.894C4.20733 4.281 3.99033 3.975 4.00033 3.72C4.00478 3.61035 4.03323 3.50302 4.08368 3.40557C4.13414 3.30812 4.20536 3.22292 4.29233 3.156C4.49433 3 4.87033 3 5.62033 3H7.30833C7.76333 3 7.99033 3 8.19733 3.061C8.38119 3.1152 8.55295 3.20414 8.70333 3.323C8.87333 3.457 9.00433 3.642 9.26733 4.013L13.5833 10.105M4.05033 21L10.6823 13.421"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        ></path>
      </svg>
    </a>
    <a href="https://discord.gg/KD8ba2uUpT" class="discord">
      <svg
        width="25"
        height="25"
        viewBox="0 0 25 25"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M11.5989 6.5003H14.2919C14.3851 6.5003 14.4764 6.47427 14.5555 6.42515C14.6347 6.37603 14.6985 6.30577 14.7399 6.2223L15.4179 4.8543C15.4664 4.75358 15.5488 4.67313 15.6506 4.62706C15.7524 4.58098 15.8673 4.57222 15.9749 4.6023C16.6309 4.7903 18.0049 5.2433 19.1029 6.0003C22.9669 8.8973 22.6069 15.3903 22.5779 16.7603C22.5765 16.8444 22.5541 16.9269 22.5129 17.0003C20.5299 20.5003 17.0899 20.5003 17.0899 20.5003L15.9239 18.0743M15.9239 18.0743C16.4479 17.9163 17.0029 17.7253 17.6029 17.5003M15.9239 18.0743C13.4799 18.8093 11.7219 18.8083 9.27791 18.0733M13.5989 6.5003H10.9109C10.8179 6.50039 10.7266 6.47451 10.6475 6.42557C10.5683 6.37664 10.5044 6.30659 10.4629 6.2233L9.77991 4.8533C9.73146 4.75279 9.64925 4.6725 9.54762 4.62644C9.446 4.58038 9.33142 4.57148 9.22391 4.6013C8.56891 4.7893 7.19291 5.2433 6.09391 6.0003C2.23091 8.8973 2.59091 15.3903 2.61991 16.7603C2.62132 16.8445 2.64366 16.9269 2.68491 17.0003C4.66791 20.5003 8.10791 20.5003 8.10791 20.5003L9.27791 18.0733M9.27791 18.0733C8.75491 17.9163 8.19891 17.7253 7.59891 17.5003M10.6009 12.5003C10.6009 12.7655 10.4956 13.0199 10.308 13.2074C10.1205 13.3949 9.86612 13.5003 9.60091 13.5003C9.33569 13.5003 9.08134 13.3949 8.8938 13.2074C8.70626 13.0199 8.60091 12.7655 8.60091 12.5003C8.60091 12.2351 8.70626 11.9807 8.8938 11.7932C9.08134 11.6057 9.33569 11.5003 9.60091 11.5003C9.86612 11.5003 10.1205 11.6057 10.308 11.7932C10.4956 11.9807 10.6009 12.2351 10.6009 12.5003ZM16.6029 12.5003C16.6029 12.7655 16.4976 13.0199 16.31 13.2074C16.1225 13.3949 15.8681 13.5003 15.6029 13.5003C15.3377 13.5003 15.0833 13.3949 14.8958 13.2074C14.7083 13.0199 14.6029 12.7655 14.6029 12.5003C14.6029 12.2351 14.7083 11.9807 14.8958 11.7932C15.0833 11.6057 15.3377 11.5003 15.6029 11.5003C15.8681 11.5003 16.1225 11.6057 16.31 11.7932C16.4976 11.9807 16.6029 12.2351 16.6029 12.5003Z"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        ></path>
      </svg>
    </a>
  </div>
</div>
