import { Component } from '@angular/core';
import { RecipeService } from './shared/services/recipe.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrl: './app.component.less'
})
export class AppComponent {

  foodOfRecipesComp = 'food-of-recipes'
  messagesComp = 'messages'

  constructor(private recipeService: RecipeService) { }

  onSelect(event: string) {
    this.foodOfRecipesComp = event;
    this.messagesComp = event;
  }
}
