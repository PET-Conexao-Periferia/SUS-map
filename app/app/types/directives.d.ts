import { type Directive } from 'vue'

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        vMask: Directive<HTMLElement, string>
    }
}