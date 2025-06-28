# Setup Your Own Contact Form Backend (No Third-Party Dependencies)

This guide will help you set up your own contact form backend without relying on any third-party services.

## ✅ Benefits of Your Own Backend

- **No third-party dependencies** - Complete control over your data
- **Professional email handling** - Custom branded emails
- **Auto-reply functionality** - Automatic thank you emails to customers
- **Security features** - Rate limiting, validation, spam protection
- **Customizable** - Add features like admin dashboard, message storage, etc.

## 🚀 Quick Setup Guide

### Step 1: Set Up Email Credentials

1. **Get Gmail App Password:**
   - Go to your Google Account → Security → 2-Step Verification
   - Enable 2-Step Verification if not already enabled
   - Go to App passwords → Generate new app password
   - Select "Mail" and copy the generated password

2. **Update Environment File:**
   ```bash
   # Edit .env file
   EMAIL_USER=your-gmail@gmail.com
   EMAIL_PASS=your-app-password-here
   RECEIVING_EMAIL=rajivsarsande@gmail.com
   ```

### Step 2: Start the Backend

```bash
# Install dependencies (if not already done)
npm install

# Start the server
npm start
```

### Step 3: Test the Contact Form

1. Open `http://localhost:3000/contact.html`
2. Fill out and submit the form
3. Check your email - you should receive the message
4. Check the sender's email - they should receive an auto-reply

## 🌐 Deploy to Production

### Option A: Deploy to Your Own Server

1. **Upload files to your server:**
   - `server.js`
   - `package.json`
   - `contact.html` (updated version)
   - `.env` (with real credentials)

2. **Install Node.js on your server:**
   ```bash
   # Ubuntu/Debian
   curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
   sudo apt-get install -y nodejs

   # CentOS/RHEL
   curl -fsSL https://rpm.nodesource.com/setup_18.x | sudo bash -
   sudo yum install -y nodejs
   ```

3. **Install dependencies and start:**
   ```bash
   npm install
   npm start
   ```

4. **Set up process manager (recommended):**
   ```bash
   npm install -g pm2
   pm2 start server.js --name "raj-advertising"
   pm2 startup
   pm2 save
   ```

### Option B: Deploy to Cloud Platforms

#### Heroku:
```bash
# Create Procfile
echo "web: node server.js" > Procfile

# Deploy
heroku create your-app-name
git add .
git commit -m "Initial commit"
git push heroku main
```

#### Railway:
- Connect your GitHub repository
- Railway will automatically detect Node.js and deploy

#### DigitalOcean App Platform:
- Connect your GitHub repository
- Select Node.js environment
- Set environment variables

## 🔧 Configuration Options

### Environment Variables

```env
# Email Configuration
EMAIL_HOST=smtp.gmail.com
EMAIL_PORT=587
EMAIL_USER=your-gmail@gmail.com
EMAIL_PASS=your-app-password
RECEIVING_EMAIL=rajivsarsande@gmail.com

# Server Configuration
PORT=3000
NODE_ENV=production

# Security
CORS_ORIGIN=https://rajledadvertising.com
```

### Customize Email Templates

Edit the email templates in `server.js`:

```javascript
// Admin notification email
const mailOptions = {
  // ... existing code ...
  html: `
    <div style="font-family: Arial, sans-serif;">
      <h2>New Contact Form Submission</h2>
      <!-- Customize this HTML -->
    </div>
  `
};

// Auto-reply email
const autoReplyOptions = {
  // ... existing code ...
  html: `
    <div style="font-family: Arial, sans-serif;">
      <h2>Thank You for Contacting Us</h2>
      <!-- Customize this HTML -->
    </div>
  `
};
```

## 🛡️ Security Features

Your backend includes:

- **Rate Limiting**: 5 requests per 15 minutes per IP
- **Input Validation**: All fields are validated and sanitized
- **Security Headers**: Helmet.js provides security headers
- **CORS Protection**: Configured for your domain
- **Error Handling**: Secure error messages

## 📧 Email Features

- **Admin Notifications**: You receive all form submissions
- **Auto-Replies**: Customers get thank you emails
- **Professional Formatting**: HTML emails with your branding
- **Spam Protection**: Built-in validation and rate limiting

## 🔍 Troubleshooting

### Email Not Sending
1. Check Gmail App Password is correct
2. Ensure 2-Step Verification is enabled
3. Verify SMTP settings in `.env`
4. Check server logs for error messages

### CORS Errors
1. Update `CORS_ORIGIN` in `.env` to match your domain
2. Ensure the frontend is making requests to the correct API URL

### Rate Limiting
If you're getting rate limit errors during testing:
```javascript
// In server.js, temporarily increase the limit:
max: 100, // Increase from 5 to 100 for testing
```

## 📈 Next Steps (Optional)

Once your basic contact form is working, you can add:

1. **Admin Dashboard**: View and manage messages
2. **Database Storage**: Store messages in a database
3. **File Uploads**: Allow customers to attach files
4. **Analytics**: Track form submissions and conversions
5. **Multi-language Support**: Support multiple languages

## 🎉 You're Done!

Your contact form now:
- ✅ Uses your own backend (no third-party dependencies)
- ✅ Sends professional emails
- ✅ Includes security features
- ✅ Is fully customizable
- ✅ Works reliably

The contact form will work immediately once you set up the email credentials and start the server! 