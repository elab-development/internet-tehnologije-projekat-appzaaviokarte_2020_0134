import { Component, OnInit, ViewChild } from '@angular/core';
import { BookingService } from '../../../services/booking.service';
import { UserService } from '../../../services/user.service';
import { MatTableDataSource } from '@angular/material/table';
import { Airport } from '../../../models/airport';
import { MatPaginator } from '@angular/material/paginator';

@Component({
  selector: 'app-bookings',
  templateUrl: './bookings.component.html',
  styleUrls: ['./bookings.component.scss'],
})
export class BookingsComponent implements OnInit {
  bookings: any[] = [];
  filteredBookings: any[] = [];
  searchTerm: string = '';
  currentPage: number = 0;
  pageSize: number = 4;

  @ViewChild(MatPaginator) paginator: MatPaginator;

  constructor(private bookingService: BookingService) {}

  ngOnInit(): void {
    this.loadBookings();
  }

  loadBookings(): void {
    this.bookingService.getAllBookingsData().subscribe((data: any[]) => {
      this.bookings = data;
      this.filteredBookings = data;
      this.updatePage();
    });
  }

  applyFilter(): void {
    this.filteredBookings = this.bookings.filter(
      (booking) =>
        booking.user.username
          .toLowerCase()
          .includes(this.searchTerm.toLowerCase()) ||
        booking.flight_id == this.searchTerm ||
        booking.flight.origin
          .toLowerCase()
          .includes(this.searchTerm.toLowerCase()) ||
        booking.flight.destination
          .toLowerCase()
          .includes(this.searchTerm.toLowerCase()) ||
        booking.status.toLowerCase().includes(this.searchTerm.toLowerCase())
    );
    this.updatePage();
  }

  onPaginate(event: any): void {
    this.currentPage = event.pageIndex;
    this.pageSize = event.pageSize;
    this.updatePage();
  }

  updatePage(): void {
    const startIndex = this.currentPage * this.pageSize;
    const endIndex = startIndex + this.pageSize;
    this.filteredBookings = this.bookings.slice(startIndex, endIndex);
  }

  onDelete(booking_id: number): void {
    if (confirm('Are you sure you want to delete this booking?')) {
      this.bookingService.checkBooking(booking_id).subscribe((response) => {
        if (response.exists) {
          this.bookingService.deleteBooking(booking_id).subscribe(() => {
            this.loadBookings();
          });
        } else {
          alert('Booking does not exist.');
          this.loadBookings();
        }
      });
    }
  }
}
