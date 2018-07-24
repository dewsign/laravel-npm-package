import { AjaxStore } from 'ajax-store'

class PageStore extends AjaxStore {
    constructor() {
        super({
            action: window.route('admin.page.index', '__locale__').toString(),
        })
    }
}

export default PageStore
