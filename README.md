# Raj Advertising Website Backend

A Node.js/Express backend for the Raj Advertising website contact form with email functionality.

## Features

- ✅ Contact form processing with validation
- ✅ Email notifications to admin
- ✅ Auto-reply emails to customers
- ✅ Rate limiting for spam protection
- ✅ Security headers with Helmet
- ✅ CORS configuration
- ✅ Input validation and sanitization
- ✅ Error handling and logging
- ✅ Health check endpoint

## Prerequisites

- Node.js (v14 or higher)
- npm or yarn
- Gmail account with App Password (for email functionality)

## Setup Instructions

### 1. Install Dependencies

```bash
npm install
```

### 2. Environment Configuration

1. Copy the environment example file:
```bash
cp env.example .env
```

2. Edit `.env` file with your email credentials:
```env
# Email Configuration
EMAIL_HOST=smtp.gmail.com
EMAIL_PORT=587
EMAIL_USER=your-gmail@gmail.com
EMAIL_PASS=your-app-password
RECEIVING_EMAIL=rajivsarsande@gmail.com

# Server Configuration
PORT=3000
NODE_ENV=development

# Security
CORS_ORIGIN=http://localhost:3000
```

### 3. Gmail App Password Setup

1. Go to your Google Account settings
2. Enable 2-Factor Authentication
3. Generate an App Password:
   - Go to Security → App passwords
   - Select "Mail" and your device
   - Copy the generated password
4. Use this password in your `.env` file

### 4. Run the Server

**Development mode:**
```bash
npm run dev
```

**Production mode:**
```bash
npm start
```

The server will start on `http://localhost:3000`

## API Endpoints

### POST /api/contact
Submit a contact form message.

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Inquiry about LED displays",
  "message": "I would like to know more about your LED display services."
}
```

**Response:**
```json
{
  "success": true,
  "message": "Your message has been sent successfully!",
  "messageId": "message-id-here"
}
```

### GET /api/health
Health check endpoint.

**Response:**
```json
{
  "status": "OK",
  "timestamp": "2024-01-01T12:00:00.000Z",
  "uptime": 123.456
}
```

## Email Features

### Admin Notification
When someone submits the contact form, you'll receive an email with:
- Contact details (name, email, subject)
- Message content
- Timestamp
- Professional HTML formatting

### Auto-Reply
Customers receive an automatic thank you email with:
- Confirmation of message receipt
- Your contact information
- Professional branding

## Security Features

- **Rate Limiting**: 5 requests per 15 minutes per IP
- **Input Validation**: All form fields are validated and sanitized
- **Security Headers**: Helmet.js provides security headers
- **CORS Protection**: Configured for your domain
- **Error Handling**: Secure error messages (no sensitive data exposed)

## Deployment

### Local Development
1. Run `npm run dev` for development with auto-reload
2. Access the website at `http://localhost:3000`

### Production Deployment
1. Set `NODE_ENV=production` in your environment
2. Update `CORS_ORIGIN` to your production domain
3. Use a process manager like PM2:
```bash
npm install -g pm2
pm2 start server.js --name "raj-advertising"
```

### Environment Variables for Production
```env
NODE_ENV=production
PORT=3000
CORS_ORIGIN=https://yourdomain.com
EMAIL_HOST=smtp.gmail.com
EMAIL_PORT=587
EMAIL_USER=your-email@gmail.com
EMAIL_PASS=your-app-password
RECEIVING_EMAIL=rajivsarsande@gmail.com
```

## File Structure

```
├── server.js              # Main server file
├── package.json           # Dependencies and scripts
├── env.example           # Environment variables template
├── .env                  # Environment variables (create this)
├── contact.html          # Updated contact form
├── index.html            # Home page
└── assets/               # Static assets
```

## Troubleshooting

### Email Not Sending
1. Check your Gmail App Password is correct
2. Ensure 2-Factor Authentication is enabled
3. Verify SMTP settings in `.env`
4. Check server logs for error messages

### CORS Errors
1. Update `CORS_ORIGIN` in `.env` to match your domain
2. Ensure the frontend is making requests to the correct API URL

### Rate Limiting
If you're getting rate limit errors during testing, you can temporarily increase the limit in `server.js`:
```javascript
max: 100, // Increase from 5 to 100 for testing
```

## Support

For issues or questions:
- Email: rajivsarsande@gmail.com
- Phone: +91 77987 33860

## License

MIT License - feel free to modify and use as needed. 