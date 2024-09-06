import React from 'react';
import { Container, Typography, TextField, Button, Box, Grid, Link } from '@mui/material';

const CustomerRegister = () => {
  return (
    <>
      <Box>
        
          <Box sx={{ 
                 
                minHeight: '100vh', 
                padding: 3, 
                display: 'flex', 
                justifyContent: 'center', 
                alignItems: 'center'}}>
            <Container>
              <Grid container spacing={2} justifyContent="center">
                <Grid item xs={12} sm={6}>
                  <Box
                    component="form"
                    sx={{
                      width: '100%',
                      padding: 4,
                      backgroundColor: '#fff',
                      borderRadius: 2,
                      boxShadow: 3,
                      justifyContent: "center",
                      
                    }}
                  >
                    <Typography variant="h5" justifyContent="center" sx={{fontFamily: 'Inter, sans-serif', paddingBottom: 2}} gutterBottom>
                      Customer Registration
                    </Typography>

                    <Grid container spacing={2}>
                      <Grid item xs={12} sm={6}>
                        <TextField
                          label="Given Name"
                          variant="outlined"
                          fullWidth
                          sx={{ marginBottom: 2 }}
                        />
                      </Grid>
                      <Grid item xs={12} sm={6}>
                        <TextField
                          label="Last Name"
                          variant="outlined"
                          fullWidth
                          sx={{ marginBottom: 2 }}
                        />
                      </Grid>
                    </Grid>
                    <TextField
                      label="Username"
                      variant="outlined"
                      type="username"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />
                    
                    <TextField
                      label="Password"
                      variant="outlined"
                      type="password"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />
                    <TextField
                      label="Confirm Password"
                      variant="outlined"
                      type="password"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />

                    <Button variant="contained" type="submit" sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }}fullWidth >
                      Register as Customer
                    </Button>
                    <Grid container justifyContent="flex-end">
                      <Grid item sx={{padding: 2}}>
                        <Link href="/login" variant="body2" >
                          Already have an account? Sign in
                        </Link>
                      </Grid>
                    </Grid>
                  </Box>
                </Grid>
              </Grid>
            </Container>
          </Box>
      </Box>
    </>
  );
};

export default CustomerRegister;