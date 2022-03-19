import { Component, OnInit } from '@angular/core';

import { Router, RouterEvent } from '@angular/router';

@Component({
  selector: 'app-sidenav',
  templateUrl: './sidenav.page.html',
  styleUrls: ['./sidenav.page.scss'],
})

export class SidenavPage implements OnInit {

  active = '';

  NAV = [
    {
      name: 'Catégories',
      link: '/nav/home',
      icon: 'albums'
    },
    {
      name: 'Profil',
      link: '/nav/profile',
      icon: 'person-circle'
    },
    {
      name: 'Se déconnecter',
      link: '/nav/profile',
      icon: 'log-out'
    }
  ];

  constructor(private router: Router) {
    this.router.events.subscribe((event: RouterEvent) => {
      this.active = event.url;
    });
  }

  ngOnInit() { }

}
