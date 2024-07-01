<style>
    .item-hints {
        --purple: #720c8f;
        cursor: pointer;
        position: absolute; /* Make it absolute */
        top: 0; /* Adjust these values as needed */
        left: 0; /* Adjust these values as needed */
        z-index: 1000; /* Ensure it is above other elements */
        width: 100%; /* Adjust as needed */
        padding-right: 170px;
    }

    .item-hints .hint {
        margin: 150px auto;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .item-hints .hint-dot {
        z-index: 3;
        border: 1px solid #ffe4e4;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        transform: translate(-0%, -0%) scale(0.95);
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .item-hints .hint-radius {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -125px 0 0 -125px;
        opacity: 0;
        visibility: hidden;
        transform: scale(0);
    }

    .item-hints .hint[data-position="1"] .hint-content {
        top: 85px;
        left: 50%;
        margin-left: 56px;
    }

    .item-hints .hint-content {
        width: 300px;
        position: absolute;
        z-index: 5;
        padding: 35px 0;
        opacity: 0;
        transition: opacity 0.7s ease, visibility 0.7s ease;
        color: #fff;
        visibility: hidden;
        pointer-events: none;
    }

    .item-hints .hint:hover .hint-content {
        opacity: 1;
        transition: opacity 0.7s ease, visibility 0.7s ease;
        visibility: visible;
        pointer-events: none;
    }

    .item-hints .hint-content::before {
        width: 0px;
        bottom: 29px;
        left: 0;
        content: "";
        background-color: #fff;
        height: 1px;
        position: absolute;
        transition: width 0.4s;
    }

    .item-hints .hint:hover .hint-content::before {
        width: 180px;
        transition: width 0.4s;
    }

    .item-hints .hint-content::after {
        transform-origin: 0 50%;
        transform: rotate(-225deg);
        bottom: 29px;
        left: 0;
        width: 80px;
        content: "";
        background-color: #fff;
        height: 1px;
        position: absolute;
        opacity: 1;
        transition: opacity 0.5s ease;
        transition-delay: 0s;
    }

    .item-hints .hint:hover .hint-content::after {
        opacity: 1;
        visibility: visible;
    }

    .item-hints .hint[data-position="4"] .hint-content {
        bottom: 85px;
        left: 50%;
        margin-left: 56px;
    }
</style>

<div class="item-hints">
    <div class="hint" data-position="4">
        <span class="hint-radius"></span>
        <span class="hint-dot">Tip</span>
        <div class="hint-content do--split-children">
            <p>Use Navbar to navigate the website quickly and easily.</p>
        </div>
    </div>
</div>
