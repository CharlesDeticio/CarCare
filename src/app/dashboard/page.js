'use client';
import React, { useState } from 'react';
import { Container, Typography, Grid, Box, CardMedia, Card, CardContent, IconButton, AppBar, Toolbar, TextField, Avatar, Button } from '@mui/material';

import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';

import { deepOrange } from '@mui/material/colors';


const logoUrl = "/assets/449769249_1217885939590873_7635439348389433262_n.png"; // Update with the correct path for your logo image


// palceholder images

const repairShops = [
  {
    name: 'Shop1',
    description: 'Simple Shop',
    imageUrl: '/assets/pic1.jpg'  },
  {
    name: 'Shop2',
    description: 'Simple Shop',
    imageUrl: '/assets/pic2.jpg'  },
  {
    name: 'Shop3',
    description: 'Simple Shop',
    imageUrl: '/assets/pic3.jpg'
  },
  {
    name: 'Shop4',
    description: 'Simple Shop',
    imageUrl: '/assets/pic4.jpg'
  },
];

const RepairShopCard = ({ shop }) => (
  <Card sx={{  display: 'flex', flexDirection: 'column' }}>
    {/* Display the image */}
    <CardMedia
      component="img"
      height="200"
      image={shop.imageUrl}
      alt={shop.name}
    />
    <CardContent sx={{ flexGrow: 1 }}>
      <Typography variant="h6" component="div">
        {shop.name}
      </Typography>
      <Typography variant="body2" color="text.primary">
        {shop.description}
      </Typography>
    </CardContent>
    <Box sx={{ padding: 5 }}>
      <Button variant="contained" sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }} fullWidth>
        Check Details
      </Button>
    </Box>
  </Card>
);

const App = () => {
  return (
    <>
      <Box
      sx={{
        backgroundColor: '#f0f0f0', 
        minHeight: '100vh', 
        padding: 3,
      }}
    >
      <AppBar position="static" sx={{backgroundColor: '#0d2a7c', borderRadius: '20px 20px 20px 20px', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',}}>
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
    
    <TextField
      sx={{
        backgroundColor: '#0d2a7c', borderRadius: '20px 20px 20px 20px', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
        width: '200px',
        '& .MuiOutlinedInput-root': {
          '& fieldset': {
            borderColor: 'white',
          },
          '&:hover fieldset': {
            borderColor: 'white',
          },
          '&.Mui-focused fieldset': {
            borderColor: 'white',
          },
        },
        '& .MuiInputLabel-root': {
          color: 'white',
        },
        '& .MuiInputBase-input': {
          color: 'black',
          fontSize: '0.7rem',
        },
      paddingRight: 2}}
      label="Search"
      variant="outlined"
      size="small"
      placeholder="Search here..."
    />

  <Avatar sx={{ bgcolor: deepOrange[500] }}>N</Avatar>
  
  </Toolbar>
</AppBar>

      <Container>
        <Typography variant="h4" align="center" gutterBottom sx={{ marginTop: 6, marginBottom: 6, backgroundColor: '#f3f3f3', fontFamily: 'Arial',    
                fontWeight: 'bold', }}>
                CarCare: General Repair and Maintenance
        </Typography>

        <Grid container spacing={3} justifyContent="">
          {repairShops.map((shop, index) => (
            <Grid item key={index} xs={12} sm={6} md={4} lg={3}>
              <Box sx={{ height: '100%', display: 'flex', flexDirection: 'column' }}>
                <RepairShopCard shop={shop} />
              </Box>
            </Grid>
          ))}
        </Grid>
      </Container>
      </Box>
    </>
  );
};

export default App;
