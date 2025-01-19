import { Component, OnInit } from '@angular/core';
import { RecipeService } from '../../../shared/services/recipe.service';
import { Recipe } from '../../../shared/models/recipe';

@Component({
  selector: 'app-food-of-recipe-item',
  templateUrl: './food-of-recipe-item.component.html',
  styleUrl: './food-of-recipe-item.component.less'
})
export class FoodOfRecipeItemComponent {

  public recipes: Array<Recipe>;
  public errorMsg: string;

  isFetching = false;
  loadedPost = false;

  constructor(private recipeService: RecipeService) { 
    this.recipes = [];
    this.errorMsg = '';
  }

  ngOnInit(): void {
    this.booleanPosts();
  }

  booleanPosts() {
    this.isFetching = true;
    const that = this;
    setTimeout(function() {
      that.isFetching = false;
    }, 4000);
    this.loadedPost = true;
    this.fetchPosts();
  }

  fetchPosts() {
    this.recipeService.getRecipes()
    .subscribe(
      data => {
        this.dataPostsIf(data);
      },
      error => {
        this.errorPostsIf(error);
      }
    );
  }

  dataPostsIf(data: any) {
    if (data.length) {
      this.isFetching = false;
      this.loadedPost = false;
    }
    this.recipes = data;
  }

  errorPostsIf(error: any) {
    if(error) {
      this.isFetching = false;
      this.loadedPost = false;
    }
    this.errorMsg = error.message;
  }

}
