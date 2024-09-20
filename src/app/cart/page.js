'use client';
import React, { useState } from 'react';
import { Container, Typography, Grid, Box, Divider, Card, CardContent, IconButton, AppBar, Toolbar, TextField, Avatar, Button } from '@mui/material';
import DeleteIcon from '@mui/icons-material/Delete';
import ShoppingCartCheckoutIcon from '@mui/icons-material/ShoppingCartCheckout';
import HomeIcon from '@mui/icons-material/Home';
import EventNoteIcon from '@mui/icons-material/EventNote';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import DeleteSweepIcon from '@mui/icons-material/DeleteSweep'; // Import the new icon
import { deepOrange } from '@mui/material/colors';

// Initial dummy cart items
const initialCartItems = [
  { id: 1, name: 'Brake Pads', price: 250, image: '/assets/brakepads.jpg', shop: "Auto Fixers" },
  { id: 2, name: 'Engine Oil', price: 100, image: '/assets/engineoil.jpg', shop: "Speedy Mechanics" },
];

function ShoppingCart() {
  const [cart, setCart] = useState(initialCartItems);

  // Handle item removal
  const handleRemoveItem = (id) => {
    setCart(cart.filter(item => item.id !== id));
  };

  return (
    <Box sx={{ minHeight: '100vh', backgroundColor: '#f0f0f0' }}>
      <AppBar position="static" sx={{ backgroundColor: '#0d2a7c', borderRadius: '20px 20px 20px 20px', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' }}>
        <Toolbar>
          <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
            Shopping Cart
          </Typography>
          <IconButton
            color="inherit"
            href='/dashboard'
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
              paddingRight: 2
            }}
            label="Search"
            variant="outlined"
            size="small"
            placeholder="Search here..."
          />

          <Avatar sx={{ bgcolor: deepOrange[500] }}>N</Avatar>

        </Toolbar>
      </AppBar>


      <Container sx={{ mt: 5 }}>
        <Divider sx={{ mb: 4 }} />

        {cart.length > 0 ? (
          cart.map(item => (
            <Card key={item.id} sx={{
              mb: 2,
              borderRadius: '15px',
              boxShadow: '0 6px 12px rgba(0, 0, 0, 0.1)',
              transition: 'transform 0.3s',
              '&:hover': { transform: 'scale(1.02)' },
            }}>
              <CardContent>
                <Grid container spacing={2} alignItems="center">
                  <Grid item xs={2}>
                    <img src={item.image} alt={item.name} width="80" style={{ borderRadius: '8px' }} />
                  </Grid>
                  <Grid item xs={5}>
                    <Typography variant="h6">{item.name}</Typography>
                    <Typography variant="body2" color="textSecondary">{item.shop}</Typography>
                  </Grid>
                  <Grid item xs={2}>
                    <Typography variant="body1" color="primary">${item.price.toFixed(2)}</Typography>
                  </Grid>
                  <Grid item xs={2}>
                    <IconButton onClick={() => handleRemoveItem(item.id)}>
                      <DeleteIcon color="error" />
                    </IconButton>
                  </Grid>
                </Grid>
              </CardContent>
            </Card>
          ))
        ) : (
          <Typography variant="h6" sx={{ mb: 4 }}>Your cart is empty.</Typography>
        )}

        {cart.length > 0 && (
          <Box sx={{ display: 'flex', justifyContent: 'flex-end', mt: 4 }}>
            {/* Place Order Icon Button */}
            <IconButton color="primary" sx={{ mr: 2 }}>
              <ShoppingCartCheckoutIcon fontSize="large" />
            </IconButton>
            {/* Clear Cart Icon Button */}
            <IconButton color="error" onClick={() => setCart([])}>
              <DeleteSweepIcon fontSize="large" />
            </IconButton>
          </Box>
        )}
      </Container>
    </Box>
  );
}

export default ShoppingCart;
