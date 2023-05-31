const fadeOut = () => {
    const loaderWrapper = 
    document.querySelector('.wrapper1');
    loaderWrapper.classList.add('fade1');
}

window.addEventListener('load', fadeOut);