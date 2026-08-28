<div class="stepper">

    <div class="step {{ $step >= 1 ? 'active' : '' }}">

        <div class="step-circle">
            1
        </div>

        <span>
            Informations
        </span>

    </div>


    <div class="step-line"></div>


    <div class="step {{ $step >= 2 ? 'active' : '' }}">

        <div class="step-circle">
            2
        </div>

        <span>
            Documents
        </span>

    </div>


    <div class="step-line"></div>


    <div class="step {{ $step >= 3 ? 'active' : '' }}">

        <div class="step-circle">
            3
        </div>

        <span>
            Confirmation
        </span>

    </div>

</div>