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
    new window.VLibras.Widget('https://vlibras.gov.br/app');
}