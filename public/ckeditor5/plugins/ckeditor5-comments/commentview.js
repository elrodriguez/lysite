import { View } from '@ckeditor/ckeditor5-ui';
import commentIcon from './theme/icons/add-comment.svg';

export default class CommentView extends View {
    constructor(commentData, editor) {
        super(editor.locale);

        this.setTemplate(this._createTemplate());
        this._commentData = commentData;
    }

    get commentData() {
        return this._commentData;
    }

    _createTemplate() {
        const template = `
            <span class="comment">
                <img src="${commentIcon}" alt="Comment icon">
                <span class="comment-text">{{commentData.text}}</span>
            </span>
        `;

        return template;
    }

    toModel() {
        const writer = this.editor.model.writer;

        const commentElement = writer.createElement('comment', {
            text: this.commentData.text
        });

        const commentMarker = writer.createText('');

        writer.insert(commentElement, this.commentData.range.start);
        writer.insert(commentMarker, this.commentData.range.end);

        return commentMarker;
    }
}