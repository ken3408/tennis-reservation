<div id="reservation-modal" class="reservation-modal" style="display: none;">
    <div class="reservation-modal__content">
        <div class="reservation-modal__header">
            <h2 class="reservation-modal__title">レッスンを予約しますか？</h2>
        </div>
        <div class="reservation-modal__body">
            <div class="reservation-modal__image">
                <img src="https://placehold.co/400x200" alt="レッスン画像">
            </div>

            <div class="reservation-modal__info">
                <div class="reservation-modal__info-item">
                    <div class="reservation-modal__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <span class="reservation-modal__label">時間：</span>
                    <span class="reservation-modal__value">A 9:10-10:40</span>
                </div>

                <div class="reservation-modal__info-item">
                    <div class="reservation-modal__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z">
                            </path>
                        </svg>
                    </div>
                    <span class="reservation-modal__label">クラス：</span>
                    <span class="reservation-modal__value">上級</span>
                </div>

                <div class="reservation-modal__info-item">
                    <div class="reservation-modal__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                            <line x1="3" x2="21" y1="9" y2="9"></line>
                            <line x1="9" x2="9" y1="21" y2="9"></line>
                        </svg>
                    </div>
                    <span class="reservation-modal__combined-text">
                        <span class="reservation-modal__label">コート番号：</span>
                        <span class="reservation-modal__value">1</span>
                    </span>
                </div>

                <div class="reservation-modal__info-item">
                    <div class="reservation-modal__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <span class="reservation-modal__combined-text">
                        <span class="reservation-modal__label">担当コーチ：</span>
                        <span class="reservation-modal__value">山口コーチ</span>
                    </span>
                </div>

                <div class="reservation-modal__info-item">
                    <div class="reservation-modal__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <span class="reservation-modal__label">定員：</span>
                    <span class="reservation-modal__value">8名</span>
                </div>
            </div>
        </div>

        <div class="reservation-modal__footer">
            <button id="cancel-button"
                class="reservation-modal__button reservation-modal__button--cancel">キャンセル</button>
            <button id="confirm-button" class="reservation-modal__button reservation-modal__button--confirm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="reservation-modal__check-icon">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                確認する
            </button>
        </div>
    </div>
</div>
<style>
    #open-modal-btn:hover {
        background-color: #1f2937;
    }

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
        overflow: hidden;
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
        padding: 1rem;
    }

    .reservation-modal__image {
        width: 100%;
        border-radius: 0.5rem;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }

    .reservation-modal__image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .reservation-modal__info {
        background-color: #f9fafb;
        border-radius: 0.5rem;
        padding: 0.75rem;
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }

    .reservation-modal__info-item {
        display: flex;
        align-items: center;
    }

    .reservation-modal__icon {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }

    .reservation-modal__label {
        color: #6b7280;
        width: 5rem;
    }

    .reservation-modal__value {
        font-weight: 500;
        color: #111827;
    }

    .reservation-modal__combined-text .reservation-modal__label {
        width: auto;
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
            width: calc(100% - 2rem);
        }

        .reservation-modal__footer {
            flex-direction: column;
        }

        .reservation-modal__button {
            width: 100%;
        }
    }
