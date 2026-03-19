# 🏨 Hotel Annapurna - Features Documentation

A comprehensive hotel management and booking system with features for **Visitors**, **Users (Customers)**, and **Admins/Staff**.

---

## 👥 Three User Roles

### 1. **Visitor** (Non-Logged In Users)
### 2. **User/Customer** (Logged In Users)
### 3. **Admin/Staff** (Administrative Users)

---

## 📖 VISITOR FEATURES (Non-Logged In Users)

### 🏠 Homepage
- ✅ View hotel image slider showcase
- ✅ Browse premium services overview
- ✅ See featured food items
- ✅ View staff members and their roles
- ✅ Call-to-action buttons to explore services

### 🛏️ Room Browsing
- ✅ View all available and booked rooms
- ✅ See room details (type, price, amenities, capacity)
- ✅ Browse room images
- ✅ Pagination to navigate through rooms
- ✅ Room pricing and daily rates
- ✅ **Must login** to book a room

### 🍽️ Menu Exploration
- ✅ View food items by categories:
  - Vegetarian (Veg)
  - Non-Vegetarian (Non-Veg)
  - Special dishes
- ✅ Browse food descriptions and prices
- ✅ View food images
- ✅ Pagination for multiple pages
- ✅ **Must login** to add to cart and order

### 🪑 Table Reservation Overview
- ✅ View available dining tables
- ✅ See table capacity, location, and pricing
- ✅ Browse table images
- ✅ **Must login** to make reservations

### 📚 Blog/News Reading
- ✅ Read published blog posts
- ✅ View blog images and content
- ✅ See blog statistics (views, likes, comments)
- ✅ Pagination for blog posts
- ✅ **Must login** to like, comment, or share

### 📞 Contact Hotel
- ✅ Fill contact form to send inquiries
- ✅ Receive confirmation messages
- ✅ Get responses from admin team

### 👤 User Authentication
- ✅ **Register** new account with email verification
  - Email validation
  - OTP verification
  - Password creation
- ✅ **Login** to access customer features
- ✅ **Forget Password** with email recovery
- ✅ **Reset Password** using email link

---

## 💳 USER/CUSTOMER FEATURES (Logged In Users)

### All Visitor Features PLUS:

### 🛍️ Shopping Cart System
- ✅ Add/remove food items to cart
- ✅ Add rooms to cart for booking
- ✅ Add tables to cart for reservation
- ✅ **Unified cart** - combine food + rooms + tables
- ✅ View cart summary with total price
- ✅ Adjust quantities before checkout
- ✅ Apply coupon codes for discounts
- ✅ See discounted prices in real-time

### 🍽️ Food Ordering
- ✅ Browse food menu by categories
- ✅ View detailed food descriptions and prices
- ✅ Add food items to cart
- ✅ Specify quantities
- ✅ See cart total with tax/charges
- ✅ Track order status
- ✅ View order history
- ✅ Cancel orders (if pending)

### 🛏️ Room Booking
- ✅ View detailed room information
- ✅ Check room amenities and capacity
- ✅ See room pricing (today's price or regular price)
- ✅ Add rooms to cart
- ✅ Select check-in and check-out dates
- ✅ View estimated total cost
- ✅ Book multiple rooms in one booking
- ✅ View booking history
- ✅ Cancel bookings (if pending)
- ✅ Track booking status

### 🪑 Table Reservation
- ✅ View all available dining tables
- ✅ Check table capacity and location
- ✅ Add table to cart for reservation
- ✅ Select reservation date and time
- ✅ Specify number of guests
- ✅ View table pricing
- ✅ Confirm reservation
- ✅ View reservation history
- ✅ Cancel reservations (if pending)

### 💳 Payment Methods
- ✅ **Cash at Counter** - Pay when receiving order
- ✅ **eSewa Payment** - Digital wallet integration
  - Initiate payment
  - Track payment status
  - Handle payment success/failure
- ✅ **Stripe Payment** - Credit/debit card integration
- ✅ View payment status (Pending/Paid/Failed)
- ✅ Download payment receipts
- ✅ Get email confirmation of payments

### 📋 Order Management
- ✅ **My Orders Page**
  - View all food orders
  - Check order status in real-time
  - See order dates and amounts
  - Cancel pending orders
  - View order details and items
  - Track estimated delivery time

### 🏆 Booking Management
- ✅ **My Bookings Page**
  - View room bookings
  - View table reservations
  - Check booking status
  - Cancel bookings (if pending)
  - See check-in/check-out dates
  - View booking amount and payment status

### 📚 Blog Interactions
- ✅ Read published blog posts
- ✅ **Like** blog posts
- ✅ **Comment** on blog posts
- ✅ **Share** blog posts
- ✅ View comments from other users
- ✅ See blog interaction statistics

### 🎟️ Coupon/Discount Codes
- ✅ View available coupons
- ✅ Apply coupon codes at checkout
- ✅ See discount amount before payment
- ✅ Validate coupon eligibility
- ✅ Track coupon usage

### 👤 Profile Management
- ✅ **View Profile Information**
  - First name and last name
  - Email address
  - Contact number
  - Role (Customer/Staff)
  - Account status
  - Registration date
  
- ✅ **Edit Profile**
  - Update first name and last name
  - Update contact number
  - Update full address:
    - Tole (neighborhood)
    - Ward number
    - Rural/Zone
    - District
    - Country
  - Save changes
  
- ✅ **Profile Picture Management**
  - Upload profile photo
  - Update profile photo
  - Display profile photo on orders/bookings
  - Supported formats: JPG, PNG, GIF (Max 5MB)

### 📧 Email Notifications
- ✅ Receive order confirmations
- ✅ Get order status updates
- ✅ Receive booking confirmations
- ✅ Get payment receipts
- ✅ Account verification emails
- ✅ Password reset emails
- ✅ Promotional emails and offers

### 🔒 Account Security
- ✅ Change password
- ✅ Secure session management
- ✅ Session timeout protection
- ✅ Logout functionality
- ✅ Email-verified accounts

---

## 🔧 ADMIN/STAFF FEATURES

### All User Features (after login as admin) PLUS:

### 📊 Dashboard & Analytics
- ✅ **Dashboard Overview**
  - Total customers count
  - Total services count (food items + rooms + tables)
  - Total staff members count
  - Total blog posts count
  
- ✅ **Recent Orders Widget**
  - View latest 5 orders
  - See customer names and order details
  - Quick order status overview
  
- ✅ **Recent Activities Log**
  - Track all user activities
  - View activity timestamps
  - Monitor system operations
  - See user names with activities

### 🍽️ Food Items Management
- ✅ **View All Food Items**
  - Display all menu items
  - Filter/search capabilities
  - Pagination support
  
- ✅ **Add New Food Item**
  - Set food name
  - Select category (Veg, Non-Veg, Special)
  - Set price
  - Add detailed description
  - Upload food images
  - Set availability status
  
- ✅ **Edit Food Item**
  - Update name, price, description
  - Change category
  - Update or replace images
  - Modify availability status
  
- ✅ **Delete Food Item**
  - Remove items from menu
  - Confirmation before deletion
  
- ✅ **Image Management**
  - Upload multiple images
  - Replace existing images
  - Validate image formats and sizes

### 🛏️ Room Management
- ✅ **View All Rooms**
  - Display all rooms
  - See room details and pricing
  - Filter by status
  - Pagination support
  
- ✅ **Add New Room**
  - Set room number
  - Select room type
  - Set capacity (persons)
  - Set base price
  - Set today's special price (optional)
  - Add amenities (comma-separated)
  - Upload room images
  - Set availability status
  
- ✅ **Edit Room**
  - Update room details
  - Change pricing
  - Update amenities
  - Replace room images
  - Modify status
  
- ✅ **Delete Room**
  - Remove rooms from system
  - Confirmation before deletion
  
- ✅ **Price Management**
  - Set regular room prices
  - Set daily special prices
  - Track price history

### 🪑 Table Management
- ✅ **View All Dining Tables**
  - Display all tables
  - See capacity and pricing
  - Filter by booking status
  - Pagination support
  
- ✅ **Add New Table**
  - Set table number
  - Set capacity (persons)
  - Select location
  - Set pricing
  - Upload table images
  - Set availability status
  
- ✅ **Edit Table**
  - Update table details
  - Change capacity and location
  - Update pricing
  - Replace table images
  - Modify status
  
- ✅ **Delete Table**
  - Remove tables from system
  
- ✅ **Table Reservations Tracking**
  - View all reservations
  - See reserved dates and times
  - Check guest count

### 📋 Order Management
- ✅ **View All Orders**
  - Display all customer orders
  - Filter by order type (food, room, table)
  - Filter by status (pending, confirmed, delivered, cancelled)
  - Search by customer name or order ID
  - Pagination support
  
- ✅ **Update Order Status**
  - Mark as pending
  - Mark as confirmed
  - Mark as delivered
  - Mark as cancelled
  - Send status notifications to customers
  
- ✅ **Order Details View**
  - See customer information
  - View items ordered
  - See order price and payment details
  - Check delivery/booking notes
  - View order timestamps
  
- ✅ **Track Orders**
  - Real-time order status
  - Payment status tracking
  - Delivery timeline
  - Order confirmation details

### 📦 Booking Management
- ✅ **View All Bookings**
  - Display room bookings
  - Display table reservations
  - Filter by status
  - Search functionality
  
- ✅ **Confirm Bookings**
  - Mark bookings as confirmed
  - Update booking status
  - Send confirmation to customers
  
- ✅ **Cancel Bookings**
  - Cancel pending bookings
  - Process cancellations
  - Handle refunds
  - Notify customers

### 👥 Customer Management
- ✅ **View All Customers**
  - Display all registered users
  - See customer details
  - Filter by status
  - Search functionality
  - Pagination support
  
- ✅ **View Customer Details**
  - See customer profile
  - View order history
  - Check booking history
  - See contact information
  - View account creation date
  
- ✅ **Customer Status Management**
  - Activate/deactivate accounts
  - View account status
  - Block/unblock users (if needed)

### 💼 Staff Management
- ✅ **View All Staff Members**
  - Display all staff
  - See role and position
  - Filter by role
  - Pagination support
  
- ✅ **Add New Staff Member**
  - Create staff accounts
  - Set staff name
  - Assign roles (staff, kitchen, delivery, etc.)
  - Upload profile picture
  - Set contact information
  
- ✅ **Edit Staff Profile**
  - Update staff information
  - Change roles and positions
  - Update contact details
  - Update profile pictures
  
- ✅ **Remove Staff**
  - Delete staff accounts
  - Archive staff records

### 📧 Contact Management
- ✅ **View All Contacts**
  - Display all customer inquiries
  - Filter by status (new, responded, closed)
  - Search functionality
  - Pagination support
  
- ✅ **Read Contact Messages**
  - View full customer inquiries
  - See submission dates
  - View customer contact information
  
- ✅ **Respond to Contacts**
  - Send email replies
  - Mark as responded
  - Close inquiries
  - Keep conversation history

### 💰 Payment Tracking
- ✅ **View All Payments**
  - Display all payment records
  - Filter by payment status (pending, paid, failed)
  - Filter by payment method (cash, esewa, stripe)
  - Search by order ID
  
- ✅ **Payment Status Management**
  - Mark payments as pending
  - Mark payments as paid
  - Handle failed payments
  - Generate payment reports
  
- ✅ **Payment Reports**
  - Daily payment summary
  - Payment method breakdown
  - Revenue tracking
  - Refund processing

### 🎟️ Coupon Management
- ✅ **View All Coupons**
  - Display active and inactive coupons
  - See coupon codes and discount amounts
  - Pagination support
  
- ✅ **Create New Coupon**
  - Set coupon code
  - Define discount percentage or amount
  - Set expiration date
  - Set minimum order value (optional)
  - Set maximum usage limit
  - Set valid categories
  
- ✅ **Edit Coupon**
  - Update coupon details
  - Change discount amounts
  - Modify expiration dates
  - Update usage limits
  
- ✅ **Delete Coupon**
  - Remove expired coupons
  - Deactivate coupons

### 📝 Blog Management
- ✅ **View All Blogs**
  - Display all blog posts
  - Filter by status (published, draft, archived)
  - Search by title
  - Pagination support
  
- ✅ **Create Blog Post**
  - Write blog title
  - Add detailed content
  - Upload blog images
  - Add category/tags
  - Set featured image
  - Save as draft or publish
  - Add meta description for SEO
  
- ✅ **Edit Blog Post**
  - Update blog content
  - Change images
  - Modify publication status
  - Edit title and description
  
- ✅ **Delete Blog Post**
  - Remove blog posts
  - Archive instead of delete option
  
- ✅ **Publish/Unpublish Blogs**
  - Schedule publication
  - Draft management
  - Publish/unpublish posts
  
- ✅ **Blog Analytics**
  - View post views
  - See likes count
  - Monitor comments count
  - Track engagement metrics

### ⭐ Reviews & Ratings
- ✅ **View All Reviews**
  - Display customer reviews
  - Filter by rating
  - Search by customer name
  - Pagination support
  
- ✅ **Moderate Reviews**
  - Approve/reject reviews
  - Mark reviews as helpful
  - Delete inappropriate reviews
  - Respond to reviews

### 📊 Reports & Analytics
- ✅ **Sales Reports**
  - Daily/weekly/monthly revenue
  - Order count statistics
  - Average order value
  - Payment method breakdown
  
- ✅ **Customer Analytics**
  - Total customers count
  - New customers per period
  - Customer retention metrics
  - Active users tracking
  
- ✅ **Inventory Tracking**
  - Available food items count
  - Available rooms count
  - Available tables count
  - Stock status monitoring
  
- ✅ **Activity Logs**
  - Track all admin activities
  - User action logging
  - System event monitoring
  - Audit trail

### 🔐 Admin Account Management
- ✅ **View Admin Profile**
  - See admin information
  - View role and permissions
  
- ✅ **Edit Admin Profile**
  - Update profile information
  - Change contact details
  - Update profile picture
  
- ✅ **Change Password**
  - Secure password update
  - Current password verification
  
- ✅ **Logout**
  - Secure session termination

### 🛡️ Access Control
- ✅ **Role-Based Access**
  - Admin access only
  - Staff access limitations
  - Permission-based features
  
- ✅ **Activity Logging**
  - Log all admin actions
  - Track modifications
  - Monitor sensitive operations
  
- ✅ **Audit Trail**
  - System event tracking
  - User action history
  - Change documentation

---

## 🔒 Security Features (All Users)

- ✅ **SQL Injection Protection** - Prepared statements
- ✅ **Password Security** - Hashing & encryption
- ✅ **Session Management** - Secure session handling
- ✅ **Email Verification** - OTP-based verification
- ✅ **Password Reset** - Secure recovery process
- ✅ **Role-Based Access Control** - Permission system
- ✅ **Activity Logging** - Track user actions
- ✅ **Data Validation** - Input validation on all forms
- ✅ **CSRF Protection** - Security tokens

---

## 📱 Technical Capabilities

- ✅ **Responsive Design** - Mobile, tablet, desktop compatible
- ✅ **Image Upload & Management** - Multiple formats supported
- ✅ **Pagination** - Efficient data loading
- ✅ **Search Functionality** - Quick item/user search
- ✅ **Filtering** - Filter by status, category, date, etc.
- ✅ **Real-Time Updates** - Dynamic content loading
- ✅ **Email Notifications** - Automated email system
- ✅ **Payment Gateway Integration** - eSewa & Stripe
- ✅ **Database Management** - MySQL with prepared statements
- ✅ **API Endpoints** - RESTful API design
- ✅ **Form Validation** - Client and server-side validation
- ✅ **Error Handling** - User-friendly error messages

---

## 🎯 Summary

### Visitor Capabilities
- Browse without account: Rooms, menu, tables, blogs, contact hotel
- View details and images
- Register and login

### Customer Capabilities
- All visitor features
- Create unified cart (food + rooms + tables)
- Place orders and bookings
- Make payments (Cash, eSewa, Stripe)
- Manage profile and addresses
- Track orders and bookings
- Interact with blogs (like, comment, share)
- Use coupon codes
- View order/booking history

### Admin/Staff Capabilities
- All customer features
- Dashboard with analytics
- Manage all products (food, rooms, tables)
- Manage orders and bookings
- Manage customers and staff
- Handle payments and refunds
- Create and manage coupons
- Create and manage blog content
- View detailed reports and analytics
- Activity logging and audit trails
- Full system administration

---

**Hotel Annapurna** - Delivering excellence in hospitality management! 🏨✨
