import { AjaxStore } from 'maxfactor-vue-support'

class PageStore extends AjaxStore {
    constructor() {
        super({
            action: window.route('admin.page.index').toString(),
        })
    }
}

export default PageStore
