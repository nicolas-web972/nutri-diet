import { Component, OnInit } from '@angular/core';
import {
  AngularFireDatabase,
  AngularFireList,
} from '@angular/fire/compat/database';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service';

@Component({
  selector: 'app-viandes',
  templateUrl: './viandes.page.html',
  styleUrls: ['./viandes.page.scss'],
})
export class ViandesPage implements OnInit {
  public viandeCategoriesName;
  constructor(
    private readonly afDatabase: AngularFireDatabase,
    private firestore: AngularFirestore,
    private dataService: DataService
  ) {}
  ngOnInit() {
    this.dataService.getCategories().subscribe((response: any) => {
      this.viandeCategoriesName = Object.keys(response.viandes);
      console.log('Liste des laitage', Object.keys(response.viandes));
    });
  }
}
