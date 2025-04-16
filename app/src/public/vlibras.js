const divEnabled = document.createElement('div');
divEnabled.setAttribute('vw', '');
divEnabled.classList.add('enabled');

const divAccessButton = document.createElement('div');
divAccessButton.setAttribute('vw-access-button', '');
divAccessButton.classList.add('active');

const divPluginWrapper = document.createElement('div');
divPluginWrapper.setAttribute('vw-plugin-wrapper', '');

const divTopWrapper = document.createElement('div');
divTopWrapper.classList.add('vw-plugin-top-wrapper');

divPluginWrapper.appendChild(divTopWrapper);
divEnabled.appendChild(divAccessButton);
divEnabled.appendChild(divPluginWrapper);

document.body.appendChild(divEnabled);

const script = document.createElement('script');
script.addEventListener('load', init);
script.src = 'https://vlibras.gov.br/app/vlibras-plugin.js';
document.body.appendChild(script);

function init() {
    script.removeEventListener('load', init);
    new window.VLibras.Widget({
        url: 'https://vlibras.gov.br/app',
        avatar: 'random',
        opacity: 1,
    });

    activeLegend();
}

function activeLegend() {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === 'class') {
                const button = mutation.target;
                if (!button.classList.contains('vp-enabled')) {
                    setTimeout(() => {
                        document.querySelector('.vpw-controls-subtitles').click();
                    }, 300);
                    observer.disconnect();
                }
            }
        });
    });

    function observeButton() {
        const button = document.querySelector('.vpw-skip-welcome-message');

        if (button) {
            observer.observe(button, { attributes: true, attributeFilter: ['class'] });
            mainObserver.disconnect();
        }
    }
    const mainObserver = new MutationObserver(() => {
        if (document.querySelector('.vpw-skip-welcome-message')) {
            observeButton();
        }
    });

    mainObserver.observe(document.body, { childList: true, subtree: true });
}
