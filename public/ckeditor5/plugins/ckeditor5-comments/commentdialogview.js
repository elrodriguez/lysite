import { View } from '@ckeditor/ckeditor5-ui';
import CommentDialogTemplate from './commentdialogtemplate';

export default class CommentDialogView extends View {
    constructor(locale) {
        super(locale);

        this.setTemplate(CommentDialogTemplate);
        this._submitButton = this.element.querySelector('#saveButton');
        this._cancelButton = this.element.querySelector('#cancelButton');
        this._commentText = this.element.querySelector('#commentText');
    }

    get cancelButton() {
        return this._cancelButton;
    }

    get submitButton() {
        return this._submitButton;
    }

    get commentText() {
        return this._commentText.value;
    }
}