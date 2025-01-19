import { EventEmitter } from '@angular/core';
import { Component, Output } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrl: './header.component.less'
})
export class HeaderComponent {

  @Output() selected = new EventEmitter<string>();

  onSelect(item: string) {
    this.selected.emit(item);
  }
  
}
