    <!-- Popup.vue -->
    <template>
      <div v-if="isVisible" class="popup-overlay" @click.self="closePopup">
        <Form class="popup-content">
          <button @click="closePopup" class="close-button">X</button>
          <slot></slot> <!-- Slot for dynamic content -->
        </Form>
      </div>
    </template>

    <script>
    export default {
      props: {
        isVisible: {
          type: Boolean,
          default: false
        }
      },
      methods: {
        closePopup() {
          this.$emit('close');
        }
      }
    };
    </script>

    <style scoped>
    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .popup-content {
      background-color: #CCD2FF;
      padding: 20px;
      border-radius: 8px;
      position: relative;
    }

    .close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      background: none;
      border-radius: 50%;
      font-size: 1.2em;
      cursor: pointer;
    }
    </style>