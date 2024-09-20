import React from 'react';
import { Container, Typography, Box, Grid, Card, CardContent, Button, Divider, IconButton, AppBar, Toolbar } from '@mui/material';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import InventoryIcon from '@mui/icons-material/Inventory';

const shopName = "CarCare Service Center";

const BookingHistoryPage = () => {
    const bookings = [
        {
            id: 1,
            customer: 'Jane Smith',
            service: 'Oil Change',
            date: '2024-09-12',
            status: 'Completed' 
        },
        {
            id: 2,
            customer: 'Bob Johnson',
            service: 'Brake Repair',
            date: '2024-09-10',
            status: 'Pending' 
        },
        {
            id: 3,
            customer: 'Alice Brown',
            service: 'Tire Replacement',
            date: '2024-08-30',
            status: 'Completed'
        }
    ];

    return (
        <Box sx={{ backgroundColor: '#f5f5f5', minHeight: '100vh', paddingTop: 3 }}>
            <AppBar position="static" sx={{ backgroundColor: '#0d2a7c', borderRadius: '20px 20px 0 0', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' }}>
                <Toolbar>
                    <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
                        {shopName} Dashboard
                    </Typography>
                    <IconButton
                        color="inherit"
                        sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}
                        href='/shopdashboard'
                    >
                        <HomeIcon />
                    </IconButton>
                    <IconButton
                        color="inherit"
                        sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}
                        href='/calendar'
                    >
                        <EventNoteIcon />
                    </IconButton>
                    <IconButton
                        color="inherit"
                        sx={{ '&:hover': { backgroundColor: '#2956de', color: '#fff' } }}
                        href='/inventory'
                    >
                        <InventoryIcon />
                    </IconButton>
                </Toolbar>
            </AppBar>

           
            <Container sx={{ padding: '40px 0' }}>
                <Typography variant="h4" gutterBottom align="center">
                    Booking History
                </Typography>
                <Grid container spacing={4}>
                    {bookings.map((booking) => (
                        <Grid item xs={12} sm={6} md={4} key={booking.id}>
                            <Card sx={{ boxShadow: 3 }}>
                                <CardContent>
                                    <Typography variant="h6" gutterBottom>
                                        {booking.service}
                                    </Typography>
                                    <Typography variant="body1" color="textSecondary">
                                        Customer: {booking.customer}
                                    </Typography>
                                    <Typography variant="body1" color="textSecondary">
                                        Date: {booking.date}
                                    </Typography>
                                </CardContent>
                                <Divider />
                                <Box sx={{ textAlign: 'right', padding: 2 }}>
                                    <Button variant="outlined" color="primary">
                                        View Details
                                    </Button>
                                </Box>
                            </Card>
                        </Grid>
                    ))}
                </Grid>
            </Container>

            
            <Box sx={{ backgroundColor: '#1141c1', color: 'white', padding: '20px 0' }}>
                <Container>
                    <Typography variant="body1" align="center">
                        © 2024 Speedy Auto Repairs. All rights reserved.
                    </Typography>
                </Container>
            </Box>
        </Box>
    );
};

export default BookingHistoryPage;
