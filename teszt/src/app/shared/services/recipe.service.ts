import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";
import { Recipe } from "../models/recipe";

@Injectable({
  providedIn: 'root'
})
export class RecipeService {

  private url = 'https://recipes-messages-server.onrender.com/recipes'

  constructor(private http: HttpClient) { }

  getRecipes(): Observable<Recipe[]> {
    return this.http.get<Recipe[]>(this.url);
  }
}
