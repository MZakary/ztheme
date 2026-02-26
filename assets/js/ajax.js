document.addEventListener('DOMContentLoaded', function () {
    const btn = document.querySelector('.load-more');
    if (!btn) return;

    btn.addEventListener('click', function () {
        const page = parseInt(btn.dataset.page) + 1;
        const max  = parseInt(btn.dataset.max);

        btn.textContent = 'Loading...';
        btn.disabled = true;

        fetch(loadMoreData.ajaxUrl, {         // ajaxUrl passed from PHP via wp_localize_script
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'load_more_posts',    // must match add_action in functions.php
                page:   page,
                nonce:  loadMoreData.nonce    // security check
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.data.html) {
                document.querySelector('.posts-grid').insertAdjacentHTML('beforeend', data.data.html);
                btn.dataset.page = page;

                // Hide button if we've hit the last page
                if (page >= max) btn.remove();
                else {
                    btn.textContent = 'Load More';
                    btn.disabled = false;
                }
            }
        });
    });
});