import { Component, OnInit } from '@angular/core';
import {
  AngularFireDatabase,
  AngularFireList,
} from '@angular/fire/compat/database';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service';

@Component({
  selector: 'app-legumes',
  templateUrl: './legumes.page.html',
  styleUrls: ['./legumes.page.scss'],
})
export class LegumesPage implements OnInit {
  public legumeCategoriesName;
  constructor(
    private readonly afDatabase: AngularFireDatabase,
    private firestore: AngularFirestore,
    private dataService: DataService
  ) {}
  ngOnInit() {
    this.dataService.getCategories().subscribe((response: any) => {
      this.legumeCategoriesName = Object.keys(response.legumes);
      console.log('Liste des legume', Object.keys(response.legumes));
    });
  }
}
