export default {
    retrieveLastError() {
        fetch('/api/visual-exceptions/latest', {
            method: 'GET',
            // This enables "cookies".
            credentials: 'same-origin',
            headers: {
                Accept: 'text/html, application/xhtml+xml',
            },
        }).then(response => {
            response.text().then(content => {
                this.showHtmlModal(content);
            });
        });
    },

    showHtmlModal(html) {
        const page = document.createElement('html');
        page.innerHTML = html;
        page.querySelectorAll('a').forEach(a =>
            a.setAttribute('target', '_top')
        );

        let modal = document.getElementById('burst-error');

        if (typeof modal !== 'undefined' && modal != null) {
            // Modal already exists.
            modal.innerHTML = '';
        } else {
            modal = document.createElement('div');
            modal.id = 'burst-error';
            modal.style.position = 'fixed';
            modal.style.width = '100vw';
            modal.style.height = '100vh';
            modal.style.padding = '50px';
            modal.style.backgroundColor = 'rgba(0, 0, 0, .6)';
            modal.style.zIndex = 200000;
        }

        const iframe = document.createElement('iframe');
        iframe.style.backgroundColor = '#17161A';
        iframe.style.borderRadius = '5px';
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        modal.appendChild(iframe);

        document.body.prepend(modal);
        document.body.style.overflow = 'hidden';
        iframe.contentWindow.document.open();
        iframe.contentWindow.document.write(page.outerHTML);
        iframe.contentWindow.document.close();

        // Close on click.
        modal.addEventListener('click', () => this.hideHtmlModal(modal));

        // Close on escape key press.
        modal.setAttribute('tabindex', 0);
        modal.addEventListener('keydown', e => {
            if (e.key === 'Escape') this.hideHtmlModal(modal);
        });
        modal.focus();
    },

    hideHtmlModal(modal) {
        modal.outerHTML = '';
        document.body.style.overflow = 'visible';
    },
};
