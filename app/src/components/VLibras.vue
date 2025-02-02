<template>
  <div ref="divEnabled" vw class="enabled">
    <div vw-access-button class="active" />
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper" />
    </div>
  </div>
</template>

<script>

const script = document.createElement('script');

const mapPosition = {
  'left': 'L',
  'right': 'R',
  'bottom': 'B',
  'top': 'T',
  'bottom-left': 'BL',
  'top-left': 'TL',
  'bottom-right': 'BR',
  'top-right': 'TR',
};

export default defineComponent({
  name: 'VLibras',

  props: {
    src: {
      type: String,
      default: 'https://vlibras.gov.br/app/vlibras-plugin.js'
    },
    urlWidget: {
      type: String,
      default: 'https://vlibras.gov.br/app'
    },
    position: {
      type: String,
      default: 'right',
      validator: value => ['left', 'right', 'bottom', 'top', 'bottom-left', 'top-left', 'bottom-right', 'top-right'].includes(value)
    },
    avatar: {
      type: String,
      default: 'random',
      validator: value => ['icaro', 'hosana', 'guga', 'random'].includes(value)
    },
    opacity: {
      type: Number,
      default: 1.0,
      validator: value => value >= 0 && value <= 1
    }
  },

  methods: {
    init() {
      const body = document.querySelector('body');
      if(this.$refs.divEnabled) {
        body.appendChild(this.$refs.divEnabled);
      }
      script.addEventListener('load', this.createWidget);
      script.src = this.src;
      body.appendChild(script);
    },
    createWidget() {
      script.removeEventListener('load', this.createWidget);
      new window.VLibras.Widget({
        url: this.urlWidget,
        position: mapPosition[this.position],
        avatar: this.avatar,
        opacity: this.opacity,
      });
    }
  },

  mounted() {
    this.init();
  }
});
</script>