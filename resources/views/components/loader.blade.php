<div id="globalLoader" class="loader-overlay d-none">
    <div class="loader-content text-center">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2 mb-0">Processing...</p>
    </div>
</div>

<style>
.loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.loader-content {
    padding: 20px;
    border-radius: 10px;
}
</style>