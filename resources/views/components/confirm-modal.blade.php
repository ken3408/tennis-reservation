<!-- filepath: /Applications/MAMP/htdocs/tennis-reservation/resources/views/components/confirm-modal.blade.php -->
<div id="confirm-modal" class="reservation-modal" style="display: none;">
    <div class="reservation-modal__content">
      <div class="reservation-modal__header">
        <h2 class="reservation-modal__title">{{ $title }}</h2>
      </div>
      <div class="reservation-modal__body">
        <div class="reservation-modal__image">
            {{ $slot }}
        </div>
      </div>
      <div class="reservation-modal__footer">
        <button id="cancel-button" class="reservation-modal__button reservation-modal__button--cancel">キャンセル</button>
        <button id="confirmBtn" class="reservation-modal__button reservation-modal__button--confirm">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          確認する
        </button>
      </div>
    </div>
  </div>
<style>
    .reservation-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 50;
}

.reservation-modal__content {
  background-color: white;
  border-radius: 0.75rem;
  width: 100%;
  max-width: 28rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.reservation-modal__header {
  padding: 1.25rem;
  border-bottom: 1px solid #e5e7eb;
}

.reservation-modal__title {
  text-align: center;
  font-size: 1.25rem;
  font-weight: 600;
  color: #111827;
  margin: 0;
}

.reservation-modal__body {
  padding: 1.5rem;
}

.reservation-modal__image {
  width: 100%;
  border-radius: 0.5rem;
  overflow: hidden;
}

.reservation-modal__image img {
  width: 100%;
  height: auto;
  display: block;
}

.reservation-modal__footer {
  padding: 1rem;
  border-top: 1px solid #e5e7eb;
  display: flex;
  justify-content: center;
  gap: 0.75rem;
}

.reservation-modal__button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.15s ease;
}

.reservation-modal__button--cancel {
  background-color: white;
  border: 1px solid #d1d5db;
  color: #374151;
}

.reservation-modal__button--cancel:hover {
  background-color: #f3f4f6;
}

.reservation-modal__button--confirm {
  background-color: #111827;
  color: white;
  border: none;
}

.reservation-modal__button--confirm:hover {
  background-color: #1f2937;
}

.reservation-modal__check-icon {
  margin-right: 0.5rem;
}

@media (max-width: 640px) {
  .reservation-modal__content {
    margin: 1rem;
  }

  .reservation-modal__footer {
    flex-direction: column;
  }

  .reservation-modal__button {
    width: 100%;
  }
}
</style>
