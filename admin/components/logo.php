<div class="silenthelp-logo">

    <div class="silenthelp-logo-icon">

        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

            <path d="
                    M20.8 8.7
                    C20.8 13.8 12 20 12 20
                    S3.2 13.8 3.2 8.7
                    C3.2 5.9 5.4 4 8 4
                    C9.7 4 11.1 4.9 12 6.2
                    C12.9 4.9 14.3 4 16 4
                    C18.6 4 20.8 5.9 20.8 8.7Z
                " />

        </svg>

    </div>

    <div class="silenthelp-logo-text">
        Silent<span>Help</span>
    </div>

</div>

<style>
    .silenthelp-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .silenthelp-logo-icon {
        width: 48px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 15px;

        background: rgba(166, 92, 255, .13);
        border: 1px solid rgba(166, 92, 255, .3);

        color: #c58aff;

        transition: .25s;
    }

    .silenthelp-logo-icon:hover {
        background: rgba(166, 92, 255, .18);
        border-color: rgba(166, 92, 255, .5);

        transform: translateY(-2px);

        box-shadow:
            0 8px 25px rgba(166, 92, 255, .15);
    }

    .silenthelp-logo-icon svg {
        width: 28px;
        height: 28px;
    }

    .silenthelp-logo-text {
        font-size: 25px;
        font-weight: 700;
        letter-spacing: -.5px;
        color: white;
    }

    .silenthelp-logo-text span {
        color: #c58aff;
    }
</style>