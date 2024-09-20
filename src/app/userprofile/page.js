import React from 'react';
import { Container, Typography, Box, Grid, Card, CardContent, Avatar, Button, TextField, Divider, IconButton, AppBar, Toolbar } from '@mui/material';
import EditIcon from '@mui/icons-material/Edit';
import CalendarTodayIcon from '@mui/icons-material/CalendarToday';
import Link from 'next/link';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import { deepOrange } from '@mui/material/colors';

const ProfilePage = () => {
    return (
        <Box sx={{ backgroundColor: '#f5f5f5', minHeight: '100vh', paddingTop: 3 }}>
            {/* AppBar */}
            <AppBar position="static" sx={{ backgroundColor: '#0d2a7c', borderRadius: '20px 20px 20px 20px', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)', }}>
                <Toolbar>
                    <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
                        Welcome Back, User!
                    </Typography>
                    <IconButton
                        color="inherit"
                        sx={{
                            '&:hover': {
                                backgroundColor: '#2956de',
                                color: '#fff',
                            },
                        }}
                        href='/dashboard'
                    >
                        <HomeIcon />
                    </IconButton>
                    <IconButton
                        color="inherit"
                        sx={{
                            '&:hover': {
                                backgroundColor: '#2956de',
                                color: '#fff',
                            },
                        }}
                    >
                        <EventNoteIcon />
                    </IconButton>
                    <IconButton
                        color="inherit"
                        href='/cart'
                        sx={{
                            '&:hover': {
                                backgroundColor: '#2956de',
                                color: '#fff',
                            },
                        }}
                    >
                        <ShoppingCartIcon />
                    </IconButton>

                    <Avatar sx={{ bgcolor: deepOrange[500] }}>N</Avatar>

                </Toolbar>
            </AppBar>

            <Container sx={{ padding: '40px 0' }}>
                <Grid container spacing={4} justifyContent="center">
                    {/* User Profile Card */}
                    <Grid item xs={12} sm={6} md={4}>
                        <Card sx={{ height: '100%', boxShadow: 3, textAlign: 'center', padding: 3 }}>
                            <Avatar
                                alt="User Name"
                                src="/assets/avatar-placeholder.png"
                                sx={{ width: 120, height: 120, margin: '0 auto 20px' }}
                            />
                            <Typography variant="h5" gutterBottom>
                                John Doe
                            </Typography>
                            <Typography variant="body1" color="textSecondary">
                                johndoe@example.com
                            </Typography>
                            <Typography variant="body1" color="textSecondary">
                                +1 (123) 456-7890
                            </Typography>
                            <Button
                                variant="outlined"
                                color="primary"
                                sx={{ mt: 2 }}
                                startIcon={<EditIcon />}
                            >
                                Edit Profile
                            </Button>
                        </Card>
                    </Grid>

                    <Grid item xs={12} sm={12} md={8}>
                        <Card sx={{ height: '100%', boxShadow: 3, padding: 3 }}>
                            <Typography variant="h6" gutterBottom>
                                Personal Information
                            </Typography>
                            <Divider sx={{ mb: 3 }} />
                            <Grid container spacing={2}>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        fullWidth
                                        label="First Name"
                                        variant="outlined"
                                        defaultValue="John"
                                    />
                                </Grid>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        fullWidth
                                        label="Last Name"
                                        variant="outlined"
                                        defaultValue="Doe"
                                    />
                                </Grid>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        fullWidth
                                        label="Email"
                                        variant="outlined"
                                        defaultValue="johndoe@example.com"
                                    />
                                </Grid>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        fullWidth
                                        label="Phone Number"
                                        variant="outlined"
                                        defaultValue="+1 (123) 456-7890"
                                    />
                                </Grid>
                            </Grid>
                            <Box sx={{ textAlign: 'right', mt: 3 }}>
                                <Button variant="contained" color="primary">
                                    Save Changes
                                </Button>
                            </Box>
                        </Card>
                    </Grid>
                </Grid>
            </Container>

            <Container sx={{ padding: '40px 0' }}>
                <Typography variant="h4" gutterBottom align="center">
                    Your Booking History
                </Typography>
                <Grid container spacing={4} justifyContent="center">
                    <Grid item xs={12} sm={6} md={4}>
                        <Card sx={{ height: '100%', boxShadow: 3 }}>
                            <CardContent sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                                <IconButton color="primary" sx={{ fontSize: 60 }}>
                                    <CalendarTodayIcon />
                                </IconButton>
                                <Typography variant="h6" gutterBottom>
                                    View Your Past Bookings
                                </Typography>
                                <Typography variant="body1" align="center">
                                    Access and manage all your past repair and maintenance bookings with ease.
                                </Typography>
                                <Button variant="contained" color="primary" sx={{ mt: 2 }} href="/booking-history">
                                    View Bookings
                                </Button>
                            </CardContent>
                        </Card>
                    </Grid>
                </Grid>
            </Container>

            <Box sx={{ backgroundColor: '#1141c1', color: 'white', padding: '20px 0' }}>
                <Container>
                    <Typography variant="body1" align="center">
                        © 2024 <Link href="/about">CarCare</Link> All rights reserved.
                    </Typography>
                </Container>
            </Box>
        </Box>
    );
};

export default ProfilePage;
