<div class="step-wizard d-flex justify-content-center">
    <div class="content-step-wizard d-flex justify-content-between">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ session('step') ? (session('step') - 1) * 50 : 0 }}%;" aria-valuenow="{{ session('step') ? (session('step') - 1) * 50 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="step-item{{ (session('step') && session('step') > 0) || !session('step') ? ' active': '' }}" data-step="1">入力</div>
        <div class="step-item{{ session('step') && session('step') > 1 ? ' active': '' }}" data-step="2">確認</div>
        <div class="step-item{{ session('step') && session('step') > 2 ? ' active': '' }}" data-step="3">掲載</div>
    </div>
</div>