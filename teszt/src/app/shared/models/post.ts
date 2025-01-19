export class Post {
    private _title: string;
    private _body: string;
    private _imagePath: string;
    private _url: string;
    private _userMessage: string;

constructor(title: string, body: string, imagePath: string, url: string, userMessage: string) {
    this._title = title;
    this._body = body;
    this._imagePath = imagePath;
    this._url = url;
    this._userMessage = userMessage;
  }

  get title(): string {
    return this._title;
  }

  set title(value: string) {
    this._title = value;
  }
 
  get body(): string {
    return this._body;
  }

  set body(value: string) {
    this._body = value;
  }

  get imagePath(): string {
    return this._imagePath;
  }

  set imagePath(value: string) {
    this._imagePath = value;
  }

  get url(): string {
    return this._url;
  }

  set url(value: string) {
    this._url = value;
  }

  get userMessage(): string {
    return this._userMessage;
  }

  set userMessage(value: string) {
    this._userMessage = value;
  }
}