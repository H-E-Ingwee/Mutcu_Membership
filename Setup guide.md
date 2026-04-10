# ROLE & CONTEXT
You are an Expert Full-Stack Developer, Systems Architect, and UI/UX Specialist. We are building the "MUTCU Digital Membership Management System" for the Murang'a University of Technology Christian Union. 

Your mandate is to help me build this system using a modern, scalable, and secure architecture while strictly adhering to the organizational structures, roles, and terminologies defined in the attached MUTCU Constitution and Leadership Manual.

# TECH STACK
- Frontend: React.js (Vite/CRA), Tailwind CSS, Lucide React (Icons).
- Backend: PHP 8+ (RESTful API architecture using PDO for secure database interactions).
- Database: MySQL / MariaDB (Relational database with normalized schema).
- Brand Palette: Navy Blue (#04003d), Gold (#ff9700), Red (#ff1229), Teal (#30d5c8).

# SYSTEM ARCHITECTURE & BLUEPRINT
Read and internalize the following project documentation which outlines our exact objectives, user roles, and system modules:



📘 MUTCU Digital Membership Management System

Project Documentation & Development Blueprint

Organization: Murang'a University of Technology Christian Union (MUTCU)
Motto: Inspire Love, Hope & Godliness
Document Version: 1.0

1. Executive Summary

The MUTCU Digital Membership Management System is a modern, secure, and scalable web application specifically designed to digitize, centralize, and optimize the Christian Union's membership records and administrative workflows. The transition from manual, paper-based records—and disparate legacy PHP/Excel systems—to a robust, centralized digital platform is a critical step forward. This modernization will dramatically streamline administrative duties, significantly enhance member engagement, and provide the Executive Council with accurate, real-time data to make informed pastoral, strategic, and administrative decisions.

This system is not merely a technological upgrade; it is a structural realignment strictly guided by the MUTCU Constitution (2025) and the Leadership Manual (2025). By adhering to these foundational documents, the system ensures that all roles, ministries, data collection practices, and administrative processes faithfully reflect the CU's core principles, spiritual mandate, and organizational structure.

2. Project Objectives

Centralized Data Management: Create a highly secure, single source of truth for all member data. This includes comprehensive tracking of Personal details, Academic progression (crucial for anticipating graduations and new intakes), and Spiritual/Ministry involvement. This eliminates data silos and the risk of lost physical records.

Member Empowerment & Engagement: Provide every registered member with a personalized, intuitive dashboard. This portal allows them to view and manage their profile, track their CU involvement, register for ministries, and access educational resources about the current leadership structure. Empowering members with self-service tools fosters a stronger sense of belonging and ownership within the union.

Leadership Efficiency & Oversight: Equip the Executive Council, Ministry Coordinators, and Sub-committee leaders with targeted tools to effectively manage their respective departments. This includes the ability to track active members, communicate with ministry teams, and generate detailed, actionable reports on attendance, ministry growth, and demographic distribution.

Data Privacy, Security & Compliance: Ensure all data collected and stored aligns perfectly with the supremacy of the MUTCU Constitution and strictly adheres to the data protection laws of the Republic of Kenya (e.g., the Data Protection Act, 2019). The system must employ robust encryption, secure authentication, and clear data governance policies to protect the sensitive information of all members.

3. User Roles & Access Levels

The system is meticulously designed with a strict Role-Based Access Control (RBAC) architecture to ensure data security, privacy, and proper organizational governance as mandated by the MUTCU Constitution.

A. The General Member

Access Level: Standard (Restricted to personal data and public CU information)

Core Capabilities:

Self-Registration & Onboarding: A streamlined, user-friendly process allowing new and existing members to register using their official University Registration Number, ensuring accurate academic tracking.

Profile Management: The ability to securely view and update personal details, current year of study, course information, and contact details, keeping the database perpetually up-to-date.

Ministry Enrollment & Tracking: An interface to indicate primary and secondary ministry interests (e.g., Music, Prayer, Media, Creative Arts). Members can track their ministry history and current involvement.

Leadership Directory (Education & Transparency): Access to a visual, interactive hierarchy of the current Executive Council and Sub-committee leaders. This feature is designed to educate the general membership about the CU's leadership structure, fulfilling the constitutional mandate for leadership clarity and accessibility.

Digital Membership Card: The capability to view, download, or print a secure digital proof of MUTCU membership, potentially integrating QR code technology for quick verification at events.

B. The Administrator (Executive Council / IT Leads / Appointed Delegates)

Access Level: Elevated/Full (Comprehensive system access and administrative control)

Core Capabilities:

Dashboard Analytics & Insights: Access to a high-level, data-rich dashboard providing real-time statistics on total registered members, the proportion of active vs. inactive members, demographic breakdowns (e.g., first-years/Y1 intake vs. graduating seniors), and the distribution of members across various ministries.

Member Directory Management (CRUD): Full Create, Read, Update, and Delete (Archive) capabilities for all member records. This allows administrators to manage edge cases, correct data errors, and handle manual registrations if necessary.

Ministry & Role Management: The authority to assign members to specific ministries, verify their participation, and elevate members to leadership roles (e.g., Ministry Coordinator, Sub-committee head) within the system, granting them appropriate, localized administrative privileges.

Verification & Approval Workflows: A robust system to review and approve pending member registrations, ensuring the integrity of the database and confirming that registrants are genuine university students.

Advanced Reporting & Exporting: Tools to generate detailed, customizable reports and export membership lists (CSV/Excel format). This is vital for analyzing ministry sizes, tracking academic year distributions, and preparing comprehensive handover reports crucial for transitioning leadership at the end of the spiritual year.

4. System Modules & Features

4.1. Authentication & Security Module

Secure Login/Registration: Implementation of secure authentication protocols via Email/Password or University Registration Number, utilizing strong password hashing algorithms (e.g., bcrypt).

Password Recovery: A secure, automated password reset functionality via email links or SMS OTPs.

Session Management: Robust session management protocols including automatic timeouts for inactivity, secure cookie handling (HttpOnly, Secure flags), and clear mechanisms to ensure users are logged out securely.

4.2. Member Directory & Data Structure

Based meticulously on the constitutional requirements and the Leadership Manual, the following structured data points will be collected:

Personal Data: First Name, Last Name, Phone Number, Email Address, Gender (Optional, for demographic reporting).

Academic Data: Registration Number (Serving as the Primary Key/Unique Identifier), Course of Study, Current Year of Study (Categorized as: 1, 2, 3, 4, 5/Alumni).

MUTCU Involvement Data: * Status (Active, Pending Verification, Inactive, Alumni)

Primary Ministry (Strictly mapped to the Leadership Manual: Music, Prayer, Bible Study & Discipleship, Missions & Evangelism, Technical & Media, Creative Arts).

Leadership Role (General Member, Coordinator, Executive Council, Interim Executive).

4.3. Leadership Education Module (Member Facing)

A dedicated, prominent page within the member dashboard displaying the Executive Council (Chairperson, Vice, Secretary, Treasurer, etc.) and the Ministry Coordinators.

This module will include brief descriptions of their constitutional mandates, contact information (if public), and perhaps a photo, serving to deeply educate the general membership and foster open communication.

4.4. Ministry & Sub-Committee Management

Dedicated, restricted views for each ministry, accessible only to that ministry's Coordinator and the Executive Council. This allows leaders to see a focused list of their enrolled members.

Tools for Coordinators to manage communication within their ministry, track specific ministry attendance, and manage sub-committee assignments.

5. UI/UX & Branding Guidelines

To strongly maintain the identity and visual heritage of MUTCU, the user interface will adhere strictly to the CU's official brand guidelines.

Color Palette:

Primary: Deep Navy Blue (Representing stability, depth, and institutional strength).

Secondary: Gold/Yellow (Representing light, hope, glory, and the divine).

Backgrounds: Clean Whites and Light Grays to ensure high contrast, readability, and a modern, uncluttered aesthetic.

Typography: Implementation of clean, modern sans-serif fonts (such as Inter or Roboto). These fonts are chosen specifically for their high readability across various screen sizes, from desktop monitors to smaller mobile devices.

Responsiveness: A non-negotiable requirement is that the system must be 100% mobile-friendly and responsive. Recognizing that the vast majority of university students will access the platform primarily via smartphones, a "mobile-first" design philosophy will guide all UI development.

6. Technical Architecture

Frontend: React.js paired with Tailwind CSS. This combination allows for rapid development of a highly interactive, responsive, and modern Single Page Application (SPA) user interface.

Backend: PHP 8+ configured as a robust RESTful API. The PHP layer acts as the secure intermediary, handling all business logic, data validation, and secure database interactions, returning structured JSON data to the React frontend.

Database Interaction: Strict utilization of PDO (PHP Data Objects) with prepared statements is mandatory for all database queries. This architecture guarantees robust security against SQL injection attacks, protecting sensitive member data.

Database: A Relational Database Management System (RDBMS) such as MySQL or MariaDB. The database schema will be carefully structured and normalized to efficiently support MUTCU's specific data points (Members, Ministries, Roles, Attendance) and optimized for complex relational queries (e.g., quickly identifying all first-year students enrolled in the Music Ministry).

Hosting: * Frontend: Deployment to platforms like Vercel or Netlify, which are optimized for hosting static React SPAs and offer excellent performance through global CDNs.

Backend & DB: Deployment on reliable University servers or a standard, secure shared hosting environment capable of running modern PHP and MySQL. This provides a cost-effective, accessible, and easily maintainable deployment strategy for the CU's IT team.

7. Implementation Phases & Roadmap

Phase 1: Foundation & Prototyping (Weeks 1-2)

UI/UX Design: Finalize the visual design and interactive React Prototype, ensuring alignment with the brand guidelines.

Database Schema: Design and set up the MySQL database schema, meticulously mirroring the specific data requirements outlined in the MUTCU Constitution and Leadership Manual.

Authentication Core: Implement robust authentication flows (Login/Registration/Password Reset) on both the React (client) side and the PHP (server) side, establishing the foundation of system security.

API Foundation: Develop the core PHP REST API endpoints for basic Member and Ministry CRUD (Create, Read, Update, Delete) operations.

Phase 2: Core Features Development (Weeks 3-5)

Admin Dashboard: Build the comprehensive Admin interface, deeply integrating the React UI with the PHP backend to display the member list, generate real-time statistics, and provide editing capabilities.

Member Dashboard: Develop the personalized Member portal, including the profile view, self-service update tools, and Ministry selection interface.

Leadership Education View: Implement the interactive directory allowing members to explore the Executive Council and understand the leadership structure.

Phase 3: Testing & Refinement (Week 6)

User Acceptance Testing (UAT): Conduct thorough UAT sessions with the current Executive Council and selected general members to gather feedback on usability and functionality.

Compliance Audit: Rigorously verify that the system's workflows and data capture perfectly comply with the parameters set forth in the Leadership Manual and Constitution.

Security & Performance Testing: Heavily test all API endpoints for vulnerabilities (e.g., unauthorized access, data leaks) and thoroughly test mobile responsiveness across various devices and browsers.

Phase 4: Launch & Data Migration (Week 7)

Official Rollout: Formally launch the application, perhaps introducing it via a shared URL or projected QR code during a Main Fellowship service.

Digital Registration Campaign: Drive a high-visibility campaign encouraging all existing and new members to create their digital profiles and claim their accounts.

Legacy System Phase-Out: Systematically phase out the old PHP/Excel manual tracking methods and execute a careful migration of any relevant, accurate historical data into the new MySQL database.

8. Alignment with the MUTCU Constitution

Article 8 (Membership): The system's architecture strictly categorizes members based exactly on the definitions provided in the constitution. It dynamically tracks their rights and responsibilities via their verifiable 'Active' or 'Inactive' status.

Article 12 (Executive Council): The system's core RBAC (Role-Based Access Control) framework is designed to reserve overarching administrative powers and sensitive data access exclusively to the Executive Council, reflecting their constitutional mandate.

Appendix A (Leadership Manual): To prevent any ambiguity and ensure continuity, all Ministry categories, sub-committees, and official leadership titles hardcoded within the system are mapped directly, word-for-word, from the 2025 Leadership Manual.

Document prepared to guide the digital transformation of Murang'a University of Technology Christian Union.

# CURRENT PROTOTYPE CODE
We have already developed a fully functional UI prototype for the Frontend. Treat this code as our "Source of Truth" for the UI/UX, state structure, and component layout. 

import React, { useState, useRef } from 'react';
import { 
  Users, User, Shield, BookOpen, Music, Heart, Map, Settings, 
  LogOut, Menu, X, Search, Edit, Trash2, CheckCircle, 
  Clock, BarChart3, GraduationCap, Calendar, Camera, Download, FileText, LayoutDashboard, Globe, Phone, Mail, AlertCircle, ArrowLeft
} from 'lucide-react';

// --- BRAND COLORS ---
const COLORS = {
  navy: '#04003d',
  gold: '#ff9700',
  red: '#ff1229',
  teal: '#30d5c8',
  white: '#ffffff',
  lightGray: '#f3f4f6',
};

// --- MOCK DATA ---
const MOCK_MINISTRIES = [
  'Music', 'Prayer', 'Bible Study & Training', 'Discipleship', 
  'Missions & Evangelism', 'Technical & Media', 'Creative Arts', 
  'Hospitality', 'Welfare'
];

const INITIAL_USERS = [
  { 
    id: 1, firstName: 'David', lastName: 'Mwangi', regNo: 'SC200/0396/2022', 
    email: 'david.m@student.mut.ac.ke', phone: '0712345678', course: 'BSc. Computer Science', 
    yearOfStudy: '3', status: 'Active', primaryMinistry: 'Technical & Media', role: 'General Member', avatar: null 
  },
  { 
    id: 2, firstName: 'Sarah', lastName: 'Wanjiku', regNo: 'ED101/0125/2021', 
    email: 'sarah.w@student.mut.ac.ke', phone: '0723456789', course: 'BEd. Science', 
    yearOfStudy: '4', status: 'Active', primaryMinistry: 'Executive Council', role: 'Administrator', title: 'Chairperson', avatar: null 
  },
  { 
    id: 3, firstName: 'John', lastName: 'Doe', regNo: 'IT102/0450/2023', course: 'BSc. Information Technology', yearOfStudy: '2', status: 'Pending', primaryMinistry: 'Music', role: 'General Member', avatar: null 
  },
  { 
    id: 4, firstName: 'Mary', lastName: 'Atieno', regNo: 'BB300/0880/2022', course: 'BCom. Business Admin', yearOfStudy: '3', status: 'Active', primaryMinistry: 'Prayer', role: 'General Member', avatar: null 
  },
];

const MOCK_LEADERSHIP = [
  { role: 'Chairperson', name: 'Sarah Wanjiku', ministry: 'Executive Council' },
  { role: '1st Vice Chairperson (Female)', name: 'Grace Mutheu', ministry: 'Ladies/Hospitality' },
  { role: '2nd Vice Chairperson (Male)', name: 'Brian Ochieng', ministry: 'Gents/Welfare' },
  { role: 'Secretary', name: 'Esther Njeri', ministry: 'Administration' },
  { role: 'Treasurer', name: 'Kevin Kiprono', ministry: 'Treasury' },
  { role: 'Missions & Evangelism', name: 'Daniel Kamau', ministry: 'Missions' },
];

const INITIAL_APP_CONTENT = {
  constitutionAwareness: "As a member of MUTCU, you are called to uphold our core values of Faith, Love, Hope, and Godliness. Please review Article 8 of the 2025 Constitution regarding membership rights and responsibilities. Let us remain accountable to one another as we serve.",
  leadershipIntro: "As mandated by the MUTCU Constitution (2025), the Executive Council provides spiritual oversight and strategic direction to the Christian Union. They are here to serve, guide, and pray for the union."
};

// --- LOGO COMPONENT ---
const MUTCULogo = ({ className = "w-12 h-12" }) => (
  <div className={`relative flex items-center justify-center ${className}`}>
    <div className="absolute grid grid-cols-2 grid-rows-2 gap-1 w-full h-full p-1">
      <div style={{ backgroundColor: COLORS.gold, borderTopLeftRadius: '100%' }}></div>
      <div style={{ backgroundColor: COLORS.teal, borderTopRightRadius: '100%' }}></div>
      <div style={{ backgroundColor: COLORS.navy, borderBottomLeftRadius: '50px', borderBottomRightRadius: '10px' }}></div>
      <div style={{ backgroundColor: COLORS.red, borderBottomRightRadius: '50px', borderBottomLeftRadius: '10px' }}></div>
    </div>
    <div className="absolute w-[20%] h-[110%] bg-white z-10"></div>
    <div className="absolute w-[110%] h-[20%] bg-white z-10 top-[40%]"></div>
  </div>
);

// --- MAIN APPLICATION COMPONENT ---
export default function App() {
  const [user, setUser] = useState(null);
  const [members, setMembers] = useState(INITIAL_USERS);
  const [appContent, setAppContent] = useState(INITIAL_APP_CONTENT);
  const [currentView, setCurrentView] = useState('dashboard');
  const [isSidebarOpen, setSidebarOpen] = useState(false);
  
  // Registration State
  const [isRegistering, setIsRegistering] = useState(false);
  const [regData, setRegData] = useState({
    firstName: '', lastName: '', regNo: '', email: '', phone: '', course: '', yearOfStudy: '1', primaryMinistry: MOCK_MINISTRIES[0]
  });

  // Updates the current user in the 'members' array and session
  const updateUserProfile = (updatedData) => {
    const updatedUser = { ...user, ...updatedData };
    setUser(updatedUser);
    setMembers(members.map(m => m.id === user.id ? updatedUser : m));
  };

  const handlePhotoUpload = (e) => {
    if (e.target.files && e.target.files[0]) {
      const url = URL.createObjectURL(e.target.files[0]);
      updateUserProfile({ avatar: url });
    }
  };

  const downloadCard = () => {
    window.print(); // Relies on the @media print CSS defined below
  };

  const handleRegisterSubmit = (e) => {
    e.preventDefault();
    const newUser = {
      id: members.length + 1,
      ...regData,
      status: 'Pending', // All new users require admin approval
      role: 'General Member',
      avatar: null
    };
    
    setMembers([...members, newUser]);
    setUser(newUser); // Automatically log them in after registration
    setCurrentView('dashboard');
    setIsRegistering(false); // Reset form state
    setRegData({ firstName: '', lastName: '', regNo: '', email: '', phone: '', course: '', yearOfStudy: '1', primaryMinistry: MOCK_MINISTRIES[0] });
  };

  const approveMember = (memberId) => {
    setMembers(members.map(m => m.id === memberId ? { ...m, status: 'Active' } : m));
    // If the admin is approving their own account (unlikely but possible in testing)
    if (user && user.id === memberId) {
      setUser({ ...user, status: 'Active' });
    }
  };

  // --- LOGIN & REGISTRATION SCREENS ---
  if (!user) {
    if (isRegistering) {
      return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
          <div className="max-w-2xl w-full space-y-6 bg-white p-8 rounded-2xl shadow-xl border-t-4" style={{ borderColor: COLORS.teal }}>
            <div className="flex flex-col items-center">
              <MUTCULogo className="w-16 h-16 mb-2" />
              <h2 className="text-center text-2xl font-extrabold" style={{ color: COLORS.navy }}>Member Registration</h2>
              <p className="mt-1 text-center text-sm text-gray-500">Create your digital profile to join MUTCU ministries.</p>
            </div>
            
            <form className="mt-6 space-y-4" onSubmit={handleRegisterSubmit}>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label className="block text-sm font-medium text-gray-700">First Name</label>
                  <input required type="text" className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none" style={{ focusRingColor: COLORS.navy }} value={regData.firstName} onChange={e => setRegData({...regData, firstName: e.target.value})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">Last Name</label>
                  <input required type="text" className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none" style={{ focusRingColor: COLORS.navy }} value={regData.lastName} onChange={e => setRegData({...regData, lastName: e.target.value})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">Registration Number</label>
                  <input required type="text" placeholder="e.g. SC200/0396/2022" className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none font-mono text-sm" style={{ focusRingColor: COLORS.navy }} value={regData.regNo} onChange={e => setRegData({...regData, regNo: e.target.value.toUpperCase()})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">Course of Study</label>
                  <input required type="text" placeholder="e.g. BSc. Computer Science" className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none" style={{ focusRingColor: COLORS.navy }} value={regData.course} onChange={e => setRegData({...regData, course: e.target.value})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">Email Address</label>
                  <input required type="email" className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none" style={{ focusRingColor: COLORS.navy }} value={regData.email} onChange={e => setRegData({...regData, email: e.target.value})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">Phone Number</label>
                  <input required type="tel" className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none" style={{ focusRingColor: COLORS.navy }} value={regData.phone} onChange={e => setRegData({...regData, phone: e.target.value})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">Year of Study</label>
                  <select className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none bg-white" style={{ focusRingColor: COLORS.navy }} value={regData.yearOfStudy} onChange={e => setRegData({...regData, yearOfStudy: e.target.value})}>
                    <option value="1">Year 1 (Anza FYT)</option>
                    <option value="2">Year 2 (Endelea 1)</option>
                    <option value="3">Year 3 (Endelea 2)</option>
                    <option value="4">Year 4 (Vuka FIT)</option>
                    <option value="5">Year 5 (Vuka FIT)</option>
                    <option value="Alumni">Alumni / Associate</option>
                  </select>
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700">Primary Ministry</label>
                  <select className="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:outline-none bg-white" style={{ focusRingColor: COLORS.navy }} value={regData.primaryMinistry} onChange={e => setRegData({...regData, primaryMinistry: e.target.value})}>
                    {MOCK_MINISTRIES.map(min => <option key={min} value={min}>{min}</option>)}
                  </select>
                </div>
              </div>
              
              <div className="pt-4 flex flex-col space-y-3">
                <button type="submit" className="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white shadow-md hover:opacity-90" style={{ backgroundColor: COLORS.navy }}>
                  Complete Registration
                </button>
                <button type="button" onClick={() => setIsRegistering(false)} className="w-full flex justify-center items-center py-3 px-4 text-sm font-medium text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                  <ArrowLeft className="w-4 h-4 mr-2" /> Back to Login
                </button>
              </div>
            </form>
          </div>
        </div>
      );
    }

    return (
      <div className="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div className="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border-t-4" style={{ borderColor: COLORS.navy }}>
          <div className="flex flex-col items-center">
            <MUTCULogo className="w-20 h-20 mb-4" />
            <h2 className="text-center text-3xl font-extrabold" style={{ color: COLORS.navy }}>MUTCU Digital Hub</h2>
            <p className="mt-2 text-center text-sm text-gray-600 italic">Inspire Love, Hope & Godliness</p>
          </div>
          <div className="mt-8 space-y-4">
            <p className="text-sm text-center text-gray-500 mb-4">Select a role to demo the system:</p>
            <button
              onClick={() => { setUser(members.find(m => m.role === 'General Member')); setCurrentView('dashboard'); }}
              className="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white transition-colors hover:opacity-90"
              style={{ backgroundColor: COLORS.navy }}
            >
              <User className="absolute left-4 h-5 w-5 text-white/50" /> Login as General Member
            </button>
            <button
              onClick={() => { setUser(members.find(m => m.role === 'Administrator')); setCurrentView('admin-dashboard'); }}
              className="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white transition-colors hover:opacity-90"
              style={{ backgroundColor: COLORS.gold }}
            >
              <Shield className="absolute left-4 h-5 w-5 text-white/50" /> Login as Executive Admin
            </button>
          </div>
          
          <div className="pt-6 border-t border-gray-100 text-center">
            <p className="text-sm text-gray-600">
              New to MUTCU?{' '}
              <button onClick={() => setIsRegistering(true)} className="font-bold hover:underline" style={{ color: COLORS.teal }}>
                Register here
              </button>
            </p>
          </div>
        </div>
      </div>
    );
  }

  // --- NAVIGATION CONFIG ---
  const navItems = user.role === 'Administrator' ? [
    { id: 'admin-dashboard', label: 'Admin Dashboard', icon: LayoutDashboard },
    { id: 'directory', label: 'Member Directory', icon: Users },
    { id: 'content-manager', label: 'Content Manager', icon: Globe },
    { id: 'leadership', label: 'Leadership Setup', icon: Shield },
  ] : [
    { id: 'dashboard', label: 'My Dashboard', icon: User },
    { id: 'ministry', label: 'My Ministry', icon: Heart },
    { id: 'leadership', label: 'CU Leadership', icon: Users },
  ];

  // --- VIEWS ---

  const MemberDashboard = () => (
    <div className="space-y-6">
      <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center md:items-start justify-between gap-6 print:hidden">
        <div>
          <h2 className="text-2xl font-bold text-gray-900">Welcome, {user.firstName}!</h2>
          <p className="text-gray-500 mt-1">Manage your digital MUTCU profile and membership card.</p>
        </div>
        <div className="flex gap-2">
          {user.status === 'Pending' ? (
            <span className="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
              <Clock className="w-4 h-4 mr-1.5" /> Pending Verification
            </span>
          ) : (
            <span className="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800 border border-green-200">
              <CheckCircle className="w-4 h-4 mr-1.5" /> Active Member
            </span>
          )}
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {/* Left Column: ID Card & Constitution */}
        <div className="lg:col-span-5 space-y-6">
          
          {/* Digital ID Card */}
          <div className="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 id-card-container relative">
            <div className="h-28 w-full relative" style={{ backgroundColor: COLORS.navy }}>
              <div className="absolute top-4 left-4 flex items-center">
                <MUTCULogo className="w-10 h-10 mr-2" />
                <span className="text-white font-bold text-sm tracking-widest uppercase">MUTCU</span>
              </div>
              <div className="absolute top-4 right-4 text-white text-right">
                <p className="font-bold tracking-wider text-sm">DIGITAL ID</p>
                <p className="text-xs opacity-80" style={{ color: COLORS.gold }}>2025/2026</p>
              </div>
              
              {/* Profile Photo Area */}
              <div className="absolute -bottom-12 left-6 group cursor-pointer print:cursor-default">
                <div className="w-24 h-24 bg-white rounded-xl flex items-center justify-center shadow-md border-4 border-white overflow-hidden relative">
                  {user.avatar ? (
                    <img src={user.avatar} alt="Profile" className="w-full h-full object-cover" />
                  ) : (
                    <User className="w-12 h-12 text-gray-300" />
                  )}
                  {/* Hover Overlay for Photo Upload */}
                  <label className="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer print:hidden">
                    <Camera className="w-6 h-6 text-white" />
                    <input type="file" accept="image/*" className="hidden" onChange={handlePhotoUpload} />
                  </label>
                </div>
              </div>
            </div>

            <div className="pt-16 pb-6 px-6 relative">
              <h3 className="text-2xl font-extrabold text-gray-900 uppercase tracking-tight">{user.firstName} {user.lastName}</h3>
              <p className="text-md font-bold mt-1" style={{ color: COLORS.teal }}>{user.regNo}</p>
              
              <div className="mt-4 space-y-2 text-sm text-gray-700 font-medium">
                <div className="flex items-center"><GraduationCap className="w-4 h-4 mr-3 text-gray-400" /> {user.course} <span className="ml-1 text-gray-500">(Yr {user.yearOfStudy})</span></div>
                <div className="flex items-center"><Heart className="w-4 h-4 mr-3 text-gray-400" /> {user.primaryMinistry}</div>
                <div className="flex items-center"><Phone className="w-4 h-4 mr-3 text-gray-400" /> {user.phone}</div>
              </div>

              {/* QR Code Section */}
              <div className="mt-6 pt-5 border-t border-gray-100 flex items-center justify-between">
                <div>
                  <p className="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Verification</p>
                  <p className="text-[10px] text-gray-500 max-w-[120px]">Scan QR code to verify active membership status.</p>
                </div>
                <div className="w-20 h-20 bg-gray-50 p-1 border border-gray-200 rounded-lg shadow-inner">
                  <img src={`https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(user.regNo)}`} alt="QR Code" className="w-full h-full" />
                </div>
              </div>
            </div>
          </div>
          
          <button 
            onClick={downloadCard}
            className="w-full flex justify-center items-center py-3 px-4 rounded-xl text-sm font-medium text-white shadow-sm transition-all hover:shadow-md print:hidden"
            style={{ backgroundColor: COLORS.navy }}
          >
            <Download className="w-4 h-4 mr-2" /> Download Membership Card
          </button>

        </div>

        {/* Right Column: Dynamic Content & Events */}
        <div className="lg:col-span-7 space-y-6 print:hidden">
          
          {/* Constitution & Awareness (Admin Editable) */}
          <div className="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 relative overflow-hidden">
            <div className="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-bl-full"></div>
            <h3 className="text-lg font-bold text-gray-900 mb-3 flex items-center">
              <FileText className="w-5 h-5 mr-2 text-indigo-600" /> Constitution & Awareness
            </h3>
            <p className="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">
              {appContent.constitutionAwareness}
            </p>
          </div>

          <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div className="flex justify-between items-center mb-4">
              <h3 className="text-lg font-bold text-gray-900 flex items-center">
                <Calendar className="w-5 h-5 mr-2" style={{ color: COLORS.gold }} /> Upcoming Events
              </h3>
              <button className="text-xs font-bold text-blue-600 hover:underline">View All</button>
            </div>
            <ul className="space-y-4">
              <li className="flex items-start bg-gray-50 p-3 rounded-lg border border-gray-100">
                <div className="flex-shrink-0 w-12 h-12 rounded-lg bg-blue-100 flex flex-col items-center justify-center text-blue-800">
                  <span className="text-xs font-bold uppercase">Apr</span>
                  <span className="text-lg font-bold leading-none">12</span>
                </div>
                <div className="ml-4 flex-1">
                  <p className="text-sm font-bold text-gray-900">Friday Fellowship: "Faith in Action"</p>
                  <p className="text-xs text-gray-500 mt-1 flex items-center"><Clock className="w-3 h-3 mr-1"/> 4:00 PM | Main Hall</p>
                </div>
              </li>
              <li className="flex items-start bg-gray-50 p-3 rounded-lg border border-gray-100">
                <div className="flex-shrink-0 w-12 h-12 rounded-lg bg-red-100 flex flex-col items-center justify-center text-red-800">
                  <span className="text-xs font-bold uppercase">Apr</span>
                  <span className="text-lg font-bold leading-none">14</span>
                </div>
                <div className="ml-4 flex-1">
                  <p className="text-sm font-bold text-gray-900">Sunday Main Service</p>
                  <p className="text-xs text-gray-500 mt-1 flex items-center"><Clock className="w-3 h-3 mr-1"/> 8:30 AM | Assembly Hall</p>
                </div>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  );

  const MinistryView = () => (
    <div className="space-y-6">
      <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div className="absolute inset-0 opacity-10 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-400 via-transparent to-transparent"></div>
        <Heart className="w-12 h-12 mx-auto mb-3" style={{ color: COLORS.red }} />
        <h2 className="text-2xl font-bold text-gray-900">{user.primaryMinistry}</h2>
        <p className="text-gray-500 mt-2 max-w-2xl mx-auto">
          Welcome to your ministry hub. Stay updated with meeting schedules, ministry announcements, and resources.
        </p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <h3 className="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Ministry Announcements</h3>
          <div className="space-y-4">
            <div className="p-4 rounded-lg bg-yellow-50 border border-yellow-100">
              <h4 className="text-sm font-bold text-yellow-800">Weekly Rehearsal / Meeting</h4>
              <p className="text-xs text-yellow-700 mt-1">Please note that our weekly gathering has been moved to Thursday at 5:00 PM this week due to the upcoming exams.</p>
            </div>
            <div className="p-4 rounded-lg bg-gray-50 border border-gray-100">
              <h4 className="text-sm font-bold text-gray-800">Recruitment Drive</h4>
              <p className="text-xs text-gray-600 mt-1">We are looking for new members! Encourage the Anza FYT students to sign up via their digital portal.</p>
            </div>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <h3 className="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Ministry Leadership</h3>
          <div className="flex items-center p-3 rounded-lg border border-gray-100">
             <div className="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mr-4">
               <User className="w-6 h-6 text-gray-400"/>
             </div>
             <div>
               <p className="text-sm font-bold text-gray-900">Coordinator Name</p>
               <p className="text-xs text-gray-500">Ministry Coordinator</p>
             </div>
             <button className="ml-auto p-2 bg-blue-50 text-blue-600 rounded-full hover:bg-blue-100">
               <Mail className="w-4 h-4" />
             </button>
          </div>
        </div>
      </div>
    </div>
  );

  const LeadershipView = () => (
    <div className="space-y-6">
      <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
        <h2 className="text-2xl font-bold text-gray-900">MUTCU Executive Council</h2>
        <p className="text-gray-600 mt-3 max-w-2xl mx-auto leading-relaxed">
          {appContent.leadershipIntro}
        </p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {MOCK_LEADERSHIP.map((leader, idx) => (
          <div key={idx} className="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center transition-transform hover:-translate-y-1">
            <div className="w-20 h-20 rounded-full flex items-center justify-center mb-4 border-4" style={{ borderColor: COLORS.teal, backgroundColor: COLORS.lightGray }}>
              <User className="w-10 h-10 text-gray-400" />
            </div>
            <h3 className="font-bold text-lg text-gray-900">{leader.name}</h3>
            <p className="text-sm font-bold mt-1" style={{ color: COLORS.navy }}>{leader.role}</p>
            <span className="mt-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold" style={{ backgroundColor: `${COLORS.gold}20`, color: COLORS.gold }}>
              {leader.ministry}
            </span>
          </div>
        ))}
      </div>
    </div>
  );

  const AdminDashboard = () => (
    <div className="space-y-6">
      <h2 className="text-2xl font-bold text-gray-900">Executive Dashboard</h2>
      
      {/* Stats Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {[
          { label: 'Total Members', count: members.length, icon: Users, color: COLORS.navy, bg: 'bg-blue-50' },
          { label: 'Active This Semester', count: members.filter(m=>m.status==='Active').length, icon: CheckCircle, color: COLORS.teal, bg: 'bg-teal-50' },
          { label: 'Pending Verifications', count: members.filter(m=>m.status==='Pending').length, icon: Clock, color: COLORS.gold, bg: 'bg-yellow-50' },
          { label: 'First Years (Anza FYT)', count: members.filter(m=>m.yearOfStudy==='1').length, icon: GraduationCap, color: COLORS.red, bg: 'bg-red-50' },
        ].map((stat, i) => (
          <div key={i} className="bg-white p-6 rounded-xl shadow-sm border-l-4" style={{ borderColor: stat.color }}>
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm text-gray-500 font-bold">{stat.label}</p>
                <h4 className="text-3xl font-extrabold text-gray-900 mt-1">{stat.count}</h4>
              </div>
              <div className={`p-3 rounded-lg ${stat.bg}`}><stat.icon className="w-6 h-6" style={{ color: stat.color }} /></div>
            </div>
          </div>
        ))}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Pending Approvals */}
        <div className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
          <div className="p-5 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <h3 className="text-base font-bold text-gray-900 flex items-center">
              <AlertCircle className="w-5 h-5 mr-2 text-yellow-500"/> Action Required: Pending
            </h3>
          </div>
          <div className="p-0 flex-1 overflow-auto max-h-80">
            <ul className="divide-y divide-gray-100">
              {members.filter(m=>m.status==='Pending').map(m => (
                <li key={m.id} className="p-4 flex items-center justify-between hover:bg-gray-50">
                  <div>
                    <p className="text-sm font-bold text-gray-900">{m.firstName} {m.lastName}</p>
                    <p className="text-xs text-gray-500 font-mono mt-0.5">{m.regNo} • Yr {m.yearOfStudy}</p>
                  </div>
                  <button 
                    onClick={() => approveMember(m.id)}
                    className="px-3 py-1.5 text-xs font-bold text-white bg-green-600 rounded-md hover:bg-green-700 shadow-sm transition-colors"
                  >
                    Approve
                  </button>
                </li>
              ))}
              {members.filter(m=>m.status==='Pending').length === 0 && (
                <div className="p-8 text-center text-gray-500 text-sm">No pending approvals. All caught up!</div>
              )}
            </ul>
          </div>
        </div>

        {/* Quick Links */}
        <div className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-fit">
          <div className="p-5 border-b border-gray-200 bg-gray-50">
             <h3 className="text-base font-bold text-gray-900">Admin Actions</h3>
          </div>
          <div className="p-5 grid grid-cols-2 gap-4">
             <button onClick={() => setCurrentView('content-manager')} className="p-4 border border-gray-200 rounded-xl flex flex-col items-center justify-center hover:bg-gray-50 transition-colors">
               <Globe className="w-8 h-8 mb-2" style={{ color: COLORS.navy }}/>
               <span className="text-sm font-bold text-gray-700">Edit App Content</span>
             </button>
             <button onClick={() => setCurrentView('directory')} className="p-4 border border-gray-200 rounded-xl flex flex-col items-center justify-center hover:bg-gray-50 transition-colors">
               <Users className="w-8 h-8 mb-2" style={{ color: COLORS.teal }}/>
               <span className="text-sm font-bold text-gray-700">Manage Members</span>
             </button>
          </div>
        </div>
      </div>
    </div>
  );

  const AdminDirectory = () => (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 className="text-2xl font-bold text-gray-900">Member Directory</h2>
        <div className="flex w-full sm:w-auto gap-2">
          <div className="relative flex-grow sm:flex-grow-0">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
            <input 
              type="text" 
              placeholder="Search Reg No or Name..." 
              className="pl-9 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
              style={{ focusRingColor: COLORS.navy }}
            />
          </div>
          <button className="px-4 py-2 text-white rounded-lg text-sm font-bold whitespace-nowrap shadow-sm hover:opacity-90" style={{ backgroundColor: COLORS.navy }}>
            Export CSV
          </button>
        </div>
      </div>

      <div className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left border-collapse min-w-[800px]">
            <thead>
              <tr className="border-b border-gray-200 text-sm text-gray-500 bg-gray-50">
                <th className="p-4 font-bold">Name</th>
                <th className="p-4 font-bold">Reg Number</th>
                <th className="p-4 font-bold">Contact</th>
                <th className="p-4 font-bold">Course & Year</th>
                <th className="p-4 font-bold">Ministry</th>
                <th className="p-4 font-bold text-right">Actions</th>
              </tr>
            </thead>
            <tbody className="text-sm divide-y divide-gray-100">
              {members.map((m) => (
                <tr key={m.id} className="hover:bg-gray-50">
                  <td className="p-4">
                    <p className="font-bold text-gray-900">{m.firstName} {m.lastName}</p>
                    <span className={`inline-flex items-center px-2 py-0.5 mt-1 rounded text-[10px] font-bold uppercase tracking-wider ${
                      m.status === 'Active' ? 'bg-green-100 text-green-700' :
                      m.status === 'Pending' ? 'bg-yellow-100 text-yellow-700' :
                      'bg-gray-100 text-gray-700'
                    }`}>
                      {m.status}
                    </span>
                  </td>
                  <td className="p-4 font-mono text-gray-700 font-medium">{m.regNo}</td>
                  <td className="p-4">
                    <p className="text-gray-700">{m.phone || 'N/A'}</p>
                    <p className="text-xs text-gray-400 mt-0.5">{m.email || 'N/A'}</p>
                  </td>
                  <td className="p-4">
                    <p className="text-gray-700 truncate max-w-[150px]">{m.course}</p>
                    <p className="text-xs font-bold text-gray-500 mt-0.5">Yr {m.yearOfStudy}</p>
                  </td>
                  <td className="p-4 text-gray-700 font-medium">{m.primaryMinistry}</td>
                  <td className="p-4 text-right whitespace-nowrap">
                    {m.status === 'Pending' && (
                       <button onClick={() => approveMember(m.id)} className="p-2 text-green-600 hover:bg-green-50 rounded-full transition-colors mr-1" title="Approve Member">
                         <CheckCircle className="w-4 h-4" />
                       </button>
                    )}
                    <button className="p-2 text-gray-400 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-colors"><Edit className="w-4 h-4" /></button>
                    <button className="p-2 text-gray-400 hover:text-red-600 rounded-full hover:bg-red-50 transition-colors ml-1"><Trash2 className="w-4 h-4" /></button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );

  const AdminContentManager = () => {
    const [localContent, setLocalContent] = useState(appContent);

    const handleSave = () => {
      setAppContent(localContent);
      alert("Content updated successfully. Changes are now live on member dashboards.");
    };

    return (
      <div className="space-y-6 max-w-4xl">
        <div>
          <h2 className="text-2xl font-bold text-gray-900">Content Manager</h2>
          <p className="text-gray-500 text-sm mt-1">Edit the text that appears on the user front-end.</p>
        </div>

        <div className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
          <div className="p-6 border-b border-gray-200">
            <label className="block text-sm font-bold text-gray-900 mb-2 flex items-center">
              <FileText className="w-4 h-4 mr-2" style={{ color: COLORS.navy }}/>
              Constitution & Awareness Notice
            </label>
            <p className="text-xs text-gray-500 mb-3">This text appears prominently on every member's dashboard.</p>
            <textarea 
              rows="4" 
              className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:outline-none text-sm leading-relaxed"
              style={{ focusRingColor: COLORS.navy }}
              value={localContent.constitutionAwareness}
              onChange={(e) => setLocalContent({...localContent, constitutionAwareness: e.target.value})}
            />
          </div>

          <div className="p-6">
            <label className="block text-sm font-bold text-gray-900 mb-2 flex items-center">
              <Shield className="w-4 h-4 mr-2" style={{ color: COLORS.teal }}/>
              Leadership Introduction Text
            </label>
            <p className="text-xs text-gray-500 mb-3">This text appears at the top of the 'CU Leadership' directory page.</p>
            <textarea 
              rows="3" 
              className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:outline-none text-sm leading-relaxed"
              style={{ focusRingColor: COLORS.navy }}
              value={localContent.leadershipIntro}
              onChange={(e) => setLocalContent({...localContent, leadershipIntro: e.target.value})}
            />
          </div>
          
          <div className="p-4 bg-gray-50 border-t border-gray-200 flex justify-end">
             <button 
                onClick={handleSave}
                className="px-6 py-2.5 rounded-lg text-sm font-bold text-white shadow-sm hover:opacity-90 transition-opacity"
                style={{ backgroundColor: COLORS.navy }}
             >
               Publish Changes
             </button>
          </div>
        </div>
      </div>
    );
  };

  // --- RENDER CURRENT VIEW ---
  const renderContent = () => {
    switch (currentView) {
      case 'dashboard': return <MemberDashboard />;
      case 'ministry': return <MinistryView />;
      case 'leadership': return <LeadershipView />;
      case 'admin-dashboard': return <AdminDashboard />;
      case 'directory': return <AdminDirectory />;
      case 'content-manager': return <AdminContentManager />;
      default: return <div className="p-8 text-center text-gray-500">Module under development.</div>;
    }
  };

  return (
    <>
      {/* Print Styles for the ID Card Download functionality */}
      <style>{`
        @media print {
          body { visibility: hidden; background: white; margin: 0; padding: 0; }
          .id-card-container { 
            visibility: visible; 
            position: absolute; 
            left: 50%; 
            top: 50%; 
            transform: translate(-50%, -50%); 
            width: 400px !important;
            box-shadow: none !important;
            border: 2px solid #e5e7eb !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
          }
          .print\\:hidden { display: none !important; }
          .print\\:cursor-default { cursor: default !important; }
        }
      `}</style>
      
      <div className="min-h-screen bg-gray-50 flex">
        {/* Sidebar - Desktop */}
        <aside className={`fixed inset-y-0 left-0 z-50 w-64 transform ${isSidebarOpen ? 'translate-x-0' : '-translate-x-full'} md:relative md:translate-x-0 transition duration-200 ease-in-out flex flex-col print:hidden`} style={{ backgroundColor: COLORS.navy }}>
          <div className="p-6 flex items-center gap-3">
            <MUTCULogo className="w-10 h-10" />
            <div className="flex flex-col">
              <span className="text-white font-bold text-lg leading-tight tracking-wider">MUTCU</span>
              <span className="text-[10px] font-bold uppercase tracking-widest opacity-80" style={{ color: COLORS.gold }}>System Portal</span>
            </div>
            <button className="md:hidden ml-auto text-white" onClick={() => setSidebarOpen(false)}>
              <X className="w-6 h-6" />
            </button>
          </div>

          <nav className="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <div className="mb-4 px-2 text-[10px] font-bold tracking-widest text-gray-400 uppercase">
              {user.role === 'Administrator' ? 'Admin Tools' : 'Member Menu'}
            </div>
            {navItems.map((item) => (
              <button
                key={item.id}
                onClick={() => { setCurrentView(item.id); setSidebarOpen(false); }}
                className={`w-full flex items-center px-3 py-3 rounded-lg transition-colors ${
                  currentView === item.id 
                    ? 'bg-white/10 text-white' 
                    : 'text-gray-300 hover:bg-white/5 hover:text-white'
                }`}
              >
                <item.icon className={`w-5 h-5 mr-3 ${currentView === item.id ? 'text-white' : 'text-gray-400'}`} />
                <span className="text-sm font-bold">{item.label}</span>
              </button>
            ))}
          </nav>

          <div className="p-4 border-t border-white/10">
            <button 
              onClick={() => { setUser(null); setCurrentView('dashboard'); }}
              className="w-full flex items-center px-3 py-3 text-sm font-bold text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-colors"
            >
              <LogOut className="w-5 h-5 mr-3" />
              Sign Out
            </button>
          </div>
        </aside>

        {/* Main Content Area */}
        <div className="flex-1 flex flex-col min-w-0 overflow-hidden print:overflow-visible">
          {/* Header */}
          <header className="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0 z-10 shadow-sm print:hidden">
            <button 
              className="md:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-md"
              onClick={() => setSidebarOpen(true)}
            >
              <Menu className="w-6 h-6" />
            </button>
            
            <div className="ml-auto flex items-center space-x-4">
              <div className="hidden md:flex flex-col text-right mr-2">
                <span className="text-sm font-bold text-gray-900">{user.firstName} {user.lastName}</span>
                <span className="text-[10px] font-bold uppercase tracking-wider" style={{ color: user.role === 'Administrator' ? COLORS.gold : COLORS.teal }}>
                  {user.role} {user.title ? `• ${user.title}` : ''}
                </span>
              </div>
              <div className="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold overflow-hidden border-2 border-gray-100" style={{ backgroundColor: COLORS.navy }}>
                {user.avatar ? (
                   <img src={user.avatar} alt="Avatar" className="w-full h-full object-cover" />
                ) : (
                   `${user.firstName[0]}${user.lastName[0]}`
                )}
              </div>
            </div>
          </header>

          {/* Page Content */}
          <main className="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-gray-50/50 print:p-0">
            <div className="max-w-7xl mx-auto">
              {renderContent()}
            </div>
          </main>
        </div>
        
        {/* Mobile Sidebar Overlay */}
        {isSidebarOpen && (
          <div 
            className="fixed inset-0 bg-black/50 z-40 md:hidden print:hidden"
            onClick={() => setSidebarOpen(false)}
          />
        )}
      </div>
    </>
  );
}

# CORE DIRECTIVES & RULES
1. Constitutional Supremacy: Any feature regarding roles, ministries, or discipline MUST mirror the MUTCU Constitution (2025) and Leadership Manual (2025). 

MURANG’A UNIVERSITY OF TECHNOLOGY CHRISTIAN UNION 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

MUTCU CONSTITUTION, 2025 

 

 

 

 

Inspire Love, Hope & Godliness 
© 2025 Murang'a University of Technology Christian Union (MUTCU). All rights reserved. 


 

Page 2 of 34 

 

Table of Contents 
PREAMBLE ............................................................................................................... 5 
SUPREMACY DECLARATION ................................................................................. 6 
CHAPTER ONE: NAME, VISION, AIMS & DOCTRINAL BASIS ............................. 7 
Article 1: Name & Identity ...................................................................................... 7 
1.1 Name .............................................................................................................. 7 
1.2 Identity .......................................................................................................... 7 
Article 2: The Christian Union Motto ....................................................................... 7 
Article 3: Registration ............................................................................................. 7 
Article 4: Affiliation ................................................................................................. 7 
Article 5: Vision, Mission and Core Values ............................................................... 7 
5.1 Vision Statement ............................................................................................. 7 
5.2 Mission Statement .......................................................................................... 8 
5.3 Core Values .................................................................................................... 8 
Article 6: Aims of The Christian Union .................................................................... 8 
Article 7: Doctrinal Basis ......................................................................................... 9 
CHAPTER 2: MEMBERSHIP .................................................................................. 10 
Article 8: Membership of The Christian Union ....................................................... 10 
8.1 Membership ................................................................................................. 10 
8.2 Types of Membership .................................................................................... 10 
8.3 Members’ Rights and Responsibilities ........................................................... 10 
8.4 Loss of Membership ......................................................................................... 11 
8.5 Discipline and Disciplinary Actions ................................................................... 12 
CHAPTER 3: LEADERSHIP & GOVERNANCE ..................................................... 13 
Article 9: Governance ............................................................................................ 13 
Article 10: Policy Framework ................................................................................ 13 
Article 11: Leadership Manual ............................................................................... 13 
Article 12: The Executive Council .......................................................................... 13 
12.1 The Composition and Structure .................................................................. 13 
12.2 Duties of The Executive Council .................................................................. 14 
12.3 Decision-Making Process of the Executive Council ...................................... 15 
12.4 Eligibility .................................................................................................... 15 
12.5 Terms of service of the Council Members .................................................... 15 


 

Page 3 of 34 

 

12.6 Resignation from the Executive Council ...................................................... 15 
12.7 Dissolution of the Executive Council ............................................................ 15 
12.8 Termination of Office .................................................................................. 16 
12.9 Duties of The Executive Council Office Bearers ........................................... 16 
Article 13: The Christian Union Committees .......................................................... 19 
13.1 General Committees ................................................................................... 19 
13.2 Special Committees ....................................................................................... 20 
13.3 The Office of the Patron .............................................................................. 20 
13.4 The Advisory Board .................................................................................... 20 
13.5 The Auditing Committee ............................................................................. 21 
13.6 The Resource Mobilization Committee............................................................ 21 
13.6.1 Composition ............................................................................................. 21 
13.6.2 Roles and Responsibilities ........................................................................ 22 
CHAPTER 4:  THE CHRISTIAN UNION MEETINGS ............................................ 23 
Article 14: Regular Meetings ................................................................................. 23 
Article 15: General Meetings ................................................................................. 23 
15.1 Annual General Meetings (AGM) ................................................................ 23 
15. 2 Special General Meeting ............................................................................ 24 
Article 16: Procedures at General Meetings............................................................ 24 
CHAPTER 5: NOMINATIONS AND TRANSITIONS ............................................... 25 
Article 17: Nomination College (NC) ...................................................................... 25 
17.1 Duties of the Nomination College .................................................................... 25 
17.2 Nomination Process ........................................................................................ 25 
17.3 Nomination of Committees ............................................................................. 26 
17.4 Orientation and Handing Over ....................................................................... 26 
Article 18: By- Nominations ................................................................................... 26 
18.1 Vacation of Office .................................................................................... 26 
Article 18.2: Procedure for Filling Vacancies................................................ 26 
CHAPTER 6:  FUNDS,ASSETS AND THEIR ADMINISTRATION .......................... 28 
Article 19: Inspection of accounts and list of members ............................................ 28 
Article 20: Funds and their administration ............................................................. 28 
Article 21: Auditing ............................................................................................... 28 
Article 22: The Christian Union’s Assets ................................................................ 29 


 

Page 4 of 34 

 

CHAPTER 7: DISSOLUTION, AMENDMENTS AND REVIEW OF THE 
CONSTITUTION ..................................................................................................... 30 
Article 23: Procedure of amendments..................................................................... 30 
Article 24: Constitution Review Process ................................................................. 30 
Article 25: Dissolution ........................................................................................... 30 
CHAPTER 8: GENERAL PROVISIONS .................................................................. 32 
Article 26: Partnerships ......................................................................................... 32 
26.1 Partnership Guidelines ................................................................................... 32 
Article 27: Associates Committee ........................................................................... 32 
27.1 Duties of the Associates Committee ................................................................. 33 
Article 28: Dispute Resolution ................................................................................ 33 
Article 29: Official Communication ....................................................................... 33 
Article 30: Definition of terms ................................................................................ 33 
Article 31: Supremacy and Application .................................................................. 34 
Article 32: Appendices ........................................................................................... 34 
 
 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

Page 5 of 34 

 

PREAMBLE 
We, The Christian Union-  
ACKNOWLEDGE the sovereignty of God in creation, revelation, redemption and final 
judgement: 
COMMITTED to deepen and strengthen the spiritual life of individuals, as members; 
witnesses of the Lord incarnate and seek to lead others to a personal faith in Him: 
BOUND by the calling to live holy and righteous lives based on the Holy Bible and 
following the example of Jesus Christ: 
APPRECIATE our ethnic, cultural, denominational and gender diversities, recognize The 
Christian Union as non-political, non-denominational and non-profit making society: 
ADOPT, ENACT and give this constitution to ourselves and to the future generations of 
Murang’a University of Technology Christian Union. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

GOD BLESS MUTCU 


 

Page 6 of 34 

 

SUPREMACY DECLARATION 
We declare that the Holy Bible is supreme to this Constitution and binds all members of the 
Murang’a University of Technology Christian Union. Any provision that is inconsistent with 
the Holy Bible is void to the extent of its inconsistency, and any act of omission in 
contravention of the Holy Bible is invalid. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

Page 7 of 34 

 

CHAPTER ONE: NAME, VISION, AIMS & 
DOCTRINAL BASIS 
Article 1: Name & Identity 
1.1 Name 
The name of the Society shall be Murang’a University of Technology Christian Union 
(MUTCU) herein referred to as the ‘The Christian Union (C.U)’. 
1.2 Identity 
The Christian Union shall have a logo that is a unique and memorable symbol that expresses 
our identity.  

 

 

 

 

 

The central cross signifies our Christ-centred foundation, while the four colourful quadrants 
represent the diversity of our members united as one body in Christ. 
Article 2: The Christian Union Motto 
Inspire Love, Hope and Godliness. 
Article 3: Registration 
The MUTCU shall be registered under the office of the Dean of Students of the Murang’a 
University of Technology. 
Article 4: Affiliation 
The Murang’a University of Technology Christian Union shall be affiliated to the Fellowship 
of Christian Unions (FOCUS Kenya). 
Article 5: Vision, Mission and Core Values 
5.1 Vision Statement 
To be a model Christian union that cultivates Christ-centeredness among members to 
positively impact the society. 


 

Page 8 of 34 

 

5.2 Mission Statement 
Raising a Christ-like family, equipped in all aspects of life, by encouraging unity as one body 
and reaching out to non-believers within our community and beyond. 
5.3 Core Values 
1) Faith: We are rooted in the teachings of the Bible and a personal relationship with 
Jesus Christ expressed through our commitment to prayer, worship, and in-depth 
Bible study.  
2) Love: We strive to demonstrate God's unconditional love through genuine fellowship 
and a welcoming heart for all.  
3) Hope: In a world that is often uncertain, we aim to be a source of hope, inspiring our 
community through our positive words, encouraging actions, and unwavering faith. 
4) Godliness: We are committed to striving for lives that honour and glorify God in all 
that we do, both in our personal conduct and in our collective activities.  
5) Accountability: We shall demonstrate fellowship, support, and solidarity with one 
another, fostering welfare and unity within the Christian Union, while being 
accountable and answerable to one another in all our actions and decisions. 
6) Service: We believe in putting our faith into action by reaching out to serve the 
practical needs of others within the university and the wider community. 
Article 6: Aims of The Christian Union 
The aims of The Christian Union shall be as follows: 
i. Discipleship 
To deepen and strengthen the spiritual life of its members by the study of the 
Bible, prayer and Christian fellowship. 
ii. Evangelism 
To faithfully proclaim the gospel of Jesus Christ in word and deed, with the vision 
of leading individuals into a personal faith in Him and transformed lives as His 
disciples. 
iii. Mission Work 
To share in the life of witnessing Christ by encouraging Christian Union members 
towards practical involvement in the same, according to their calling, gifting and 
training. 
iv. Leadership Development and Mentorship 
To equip The Christian Union members through modelling and mentorship, 
fostering personal responsibility and communal stewardship, so that they may 
grow into fruitful leaders with a positive influence. 

 

 


 

Page 9 of 34 

 

Article 7: Doctrinal Basis 
The doctrinal basis of The Christian Union shall be the Fundamental Truth of Christianity 
including: 
i. The unity of the Father, Son and Holy Spirit in the Godhead (Matthew 28:19, 
Colossians 2:9). 
ii. The sovereignty of God in creation, redemption and final judgment (John 1:1-5); 

 

iii. The divine inspiration and entire trustworthiness of Holy Scripture as originally 
given and its supreme authority in all matters of faith and conduct (Hebrews 4:12, 
2Timothy3:15-16). 

 

iv. The universal sinfulness and guilt of all men since the fall, rendering them subjects to 
God’s wrath and condemnation (Romans 3:10, 23). 
v. Redemption from guilt, penalty, dominion and pollution of sin(s), solely 
through the sacrificial death of the Lord Jesus Christ, the incarnate Son of 
God (Romans 6:23). 

 

vi. The bodily resurrection of the Lord Jesus Christ from the dead and His 
ascension to the right hand of God the Father (Mark 16:19). 

 

vii. The presence and the work of the Holy Spirit in the work of regeneration 
(Titus 3:5-6). 

 

viii. The justification of the sinner by the grace of God through faith alone (Galatians 
3:26, Ephesians 2:8). 

 

ix. The indwelling and the work of the Holy Spirit in every believer (Romans 8). 

 

x. The one holy universal church which is the body of Christ and to which all believers 
belong (Ephesians 2:21). 

 

xi. The expectation of personal return of the Lord Jesus Christ (1 John 2:28). 

 

xii. The unity of all believers in Christ (Ephesians 4:16); 

 

 

 

 

 

 


 

Page 10 of 34 

 

CHAPTER 2: MEMBERSHIP 
Article 8: Membership of The Christian Union 
8.1 Membership  
MUTCU membership shall comprise of full membership, special membership and associate 
membership. There shall be no membership fee. 
8.2 Types of Membership 
There shall be three types of membership: 
i. Full membership 
ii. Special membership 
iii. Associate membership 

 

I. Full Membership of The Christian Union 
Shall be open to all bona fide registered students of Murang’a University of Technology, 
who are born again and declare their faith in Lord Jesus herein after who consciously 
profess the following declaration: 

 

“I ----------------------, in joining this Union, I declare my faith in Jesus Christ as my Savior, 
my Lord and God and it is my desire by the grace of God to live a life consistent with this 
declaration. I am also determined to give active support to The Christian Union as it seeks 
to fulfill its aims.” 
A list of full members shall be kept by The Christian Union’s secretary and this declaration 
shall be renewed annually during the AGM. 
II. Special Membership of The Christian Union 
Shall be open to all bona fide registered postgraduate and Open Distance and E-learning 
students of the university who consciously profess the declaration in article 8.2 (I). 
III. Associate Membership of The Christian Union 
Shall be open to former students of MUTCU who profess Jesus Christ as their personal 
Savior and are concerned with the realization of the aims of The Christian Union. There shall 
be an Associate Register, which shall contain the names of all former graduates of Murang’a 
University of Technology Christian Union wishing to retain Associate membership. 
8.3 Members’ Rights and Responsibilities 
I. Full members 
They shall be expected to fully participate in The Christian Union’s meetings and activities, 
and are: 


 

Page 11 of 34 

 

a) Eligible to be nominated in the Christian Union leadership except for first, final 
year students and for anyone in the leadership of the Student Governing 
Council. 

 

b) Entitled to vote in any General meeting and to participate in the nomination 
of the officials of The Christian Union except for first years. 

 

c) Eligible to propose amendments in The Christian Union’s constitution. 

 

II. Special members 
They shall be: 
a) Eligible to vote in any General meeting but not to participate in the nomination of 
the officials of The Christian Union. 

 

b) Entitled to participate in The Christian Union’s activities. 

 

c) Eligible to propose amendments in The Christian Union’s constitution. 

 

III. Associate members 
They shall be: 
a) Free to participate in any General meeting and be members of Advisory Board 
and any other committees as may be set up and approved by an Annual General 
meeting. 

 

b) Free to participate in the activities of The Christian Union but shall not be 
entitled to vote or to be members of the Executive council. 

 

8.4 Loss of Membership  
A person shall lose membership upon: 
a) Expulsion and or discontinuation from the University by the authority thereof. 
b) Voluntary withdrawal and by communication to the C.U’s Executive Council in 
writing.  
c) If a member changes their faith. 
d) Contravention of Article 7 and/or their conduct has been proven to contradict the 
Christian faith prescribed in the Holy Bible.  
PROVIDED THAT loss of membership under Article 8.4 (d) shall not take effect unless the 
person affected has been afforded hearing before the disciplinary committee as outlined in 
Article 8.5. 


 

Page 12 of 34 

 

8.5 Discipline and Disciplinary Actions 
The Executive Council in consultation with the advisory board shall take disciplinary action 
against any member whom by belief or practice departs from the aims, objectives and the 
doctrinal basis of The Christian Union. The procedure is as follows:  
i. A written and/or verbal complaint shall be submitted to and received by the Executive 
Committee.  
ii. The Executive Council shall choose a team from amongst themselves which shall 
probe the said members and the witnesses and report back to the executive committee.  
iii. The Executive Council shall study the report and make a ruling in consultation with 
the advisory board. 
iv. In case confirmation of allegation, the Executive Council shall serve the member with 
a written warning.  
v. In case the member persists in his or her apostasy, the Executive Council shall 
deregister the member from The Christian Union’s database thereby denying him/her 
the privileges of being a member.  
vi. If the member was a leader, they shall be stripped of their leadership position. 
vii. If the member continues in his/her waywardness, the Executive Council shall publicly 
denounce them before the church and thus excommunicate him/her.  
viii. The deregistered member will have the liberty to apply for registration through a 
written request to the Executive Council within 14 days.  
ix. The Executive Council shall then make the final decision on whether to re-register the 
member. 
x. Following any disciplinary action, the Executive Committee, in conjunction with the 
Advisory Board, shall make reasonable efforts to seek reconciliation and restoration 
with the member, in a manner consistent with biblical principles. 

 

 

 

 

 

 

 

 

 

 


 

Page 13 of 34 

 

CHAPTER 3: LEADERSHIP & GOVERNANCE 
Article 9: Governance 
The governance of the MUTCU shall be vested on three main organs: 
1. The Executive Council 
2. The Sub-Committees 
3. The Advisory Board 
Article 10: Policy Framework 
There shall be a policy framework handbook which shall contain the guidelines of the 
operations of the CU ministries and activities. 
Article 11: Leadership Manual 
There shall be a leaders’ handbook referred to as the ‘leadership manual’, which shall:  
i. Contain practical instructions on the governance of the CU. 
ii. Be used in accordance with the provisions made in this constitution. 
iii. Only be reviewed upon proposal by not less than three quarters of the Executive 
Council and then approval to amend in a General Meeting. 
iv. Executive Council leaders shall not vie for any political post in the university 
students’ council. Thus, if a sitting Executive Council member wishes to vie for any 
political post in the university students' council, they shall first resign from their 
respective role within MUTCU. 
v. Leaders not in the Executive Council of the CU may vie for any non-executive 
political position in the university students’ leadership and responsibilities. However, 
if they wish to vie for an executive post within the university students' council, they 
shall first resign from their respective role within MUTCU. 
Article 12: The Executive Council 
12.1 The Composition and Structure 
There shall be an executive council that shall consist of the following: 
i. The Chairperson 
ii. The First Vice Chairperson 
iii. The Second Vice Chairperson 
iv. Secretary 
v. Vice Secretary 
vi. Treasurer 
vii. Prayer Coordinator 
viii. Music Coordinator 


 

Page 14 of 34 

 

ix. Missions and Evangelism Coordinator 
x. Bible Study and Training Coordinator 
xi. Discipleship Coordinator 
xii. Technical and Media Ministry Coordinator 
xiii. Creative Arts Ministry Coordinator 
12.2 Duties of The Executive Council 
The Council shall exercise such powers as given by the constitution and any other in line with 
the leadership responsibilities provided for in this constitution on behalf of the CU. Its duties 
shall include: 
i. The executive council shall be the principal governing body of The Christian Union. 
ii. The council shall be responsible for implementing and upholding the aims of The 
Christian Union and for that purpose may give directions to the office bearers as 
to the manner in which they will carry out their duties. 

 

iii. They may appoint other committees as may seem desirable for a specific 
tenure to be in charge of any activities as assigned by the Executive 
Council. 

 

iv. The council shall authorize the disbursement of all monies on behalf of The 
Christian Union except as specified in article 20 (vi) 

 

v. The Council shall hold their meetings at such times and days as shall be of 
convenience but at least once a week having the quorum which is 2/3 of members 

 

vi. The Council shall have power to co-opt and replace member(s) of the Executive 
council and committee as necessary. 

 

vii. The council shall appoint members of the Nomination College subject to article 17. 

 

viii. The Executive council shall appoint the Auditing Committee from members of The 
Christian Union. 

 

ix. The Executive Council shall appoint an interim Executive Council when deemed 
necessary. 

 

x. The Executive council in conjunction with the Nomination College shall appoint the 
subcommittee members 

 

xi. The Executive Council shall at all times ensure practice of sound doctrine. 

 


 

Page 15 of 34 

 

xii. The Executive Council shall appoint the advisory board not more than three weeks 
after taking office. 

 

xiii. Shall be the disciplinary committee in conjunction with the Advisory Board. 
12.3 Decision-Making Process of the Executive Council  
a) All decisions of the committee shall be made by consensus. 
b) In the case of lack of consensus, voting shall be done. 
c) Where a tie arises, the chairperson’s vote shall break the tie. 
12.4 Eligibility 
a) Be a full member as indicated in article 8.2 (I) 
b) Shall have completed one academic year as a student and shall not be a finalist in the 
University.  
c) Shall be a student by the time of the next duly constituted Annual General Meeting. 
d) Shall meet the Qualities of CU leaders as stipulated in the Leadership Manual. 
12.5 Terms of service of the Council Members 
a) Duly appointed council members shall hold their offices for one spiritual year. 
b) A member can be nominated for an office in the Executive Council for a maximum of 
two terms. 
c) The chairperson shall not serve for more than one term. 
12.6 Resignation from the Executive Council 
a) The resignation of any member of the Council shall be instituted by a letter of 
resignation addressed to The Executive Council through the secretary of the Christian 
Union.  
b) In the case of the resignation of the secretary, the letter shall be addressed to the 
Executive Council through the chairperson.  
c) In case of the resignation from the Executive Council, the letter MUST be copied to 
the patron and/or Advisory Board. 
d) In the case where two-thirds of the individual members of the executive council write 
to The Christian Union’s Secretary resigning as members of the executive council, it 
shall amount to a dissolution as per Article 12.7. 
12.7 Dissolution of the Executive Council 
The Executive Council shall be dissolved if:  
a) The members of The Christian Union pass a vote of no confidence in a duly 
constituted SGM to the entire executive council.  
b) Two-thirds of the individual members of the executive council write to the Christian 
Union’s Secretary resigning as members of the executive council. In this case, the 
CU’s secretary shall write a letter to the Patron(s) informing ‘them’ on the same. The 
letter must be copied to the Advisory Board. 


 

Page 16 of 34 

 

c) In case of premature dissolution, the Nomination College will be held responsible for 
the leadership of the C.U. in consultation with the patron and another nomination 
process shall be held with the coordination of the patron within four weeks from the 
day of dissolution subject to article 17.2 
d) In the event that the whole Executive Council is dissolved after more than two months 
in office, the Advisory board in conjunction with representatives from subcommittee 
leaders shall form an interim executive council before proceeding to forming a new 
Nomination College to conduct new nominations as will be stipulated by the Advisory 
Board. 
12.8 Termination of Office 
Other than voluntary resignation, a member of the executive shall cease to hold office on the 
following grounds:  
a) Gross misconduct and/or; 
b) he/she has been out of session for more than one semester; 
c) differ from the doctrinal basis of this constitution. 
d) Fails to perform duties effectively as stipulated in this constitution. 
e) Where at least two-thirds of the full members in a special general meeting pass a vote 
of no confidence in the member of the executive council.  
f) Any other sufficient case at the discretion of the executive council in consultation 
with the office of the patron, the advisory, and a FOCUS staff. This shall be 
communicated in writing to the concerned member by the executive council within a 
measurable duration of time and members of the CU will be informed of the same. 

 

12.9 Duties of The Executive Council Office Bearers 
A. The Chairperson 
The Chairperson and the first Vice Chairperson shall not be of the same gender.  
The duties of the Chairperson shall be as follows; 
i. He/she shall be responsible for guiding The Executive Council and The Christian 
Union in such a way to achieve The Christian Union’s aims. 
ii. Shall preside and convene over all Executive Council meetings. 
iii. Shall be a mandatory signatory of The Christian Union’s bank account(s). 
iv. Shall together with the Secretary attend all the internal or external Christian 
Unions meetings. 
v. Shall dissolve the Nomination College 21 days after the AGM. 
vi. Shall disband the acting Executive Council upon handing over to the initial office 
bearers. 
vii. Shall be the secretary to The Christian Union’s Advisory Board. 
viii. Shall oversee the leadership development forums and trainings 
ix. Shall chair all AGMs and SGMs. 


 

Page 17 of 34 

 

x. Shall oversee to ensure harmonious coordination of all ministries of The Christian 
Union. 
xi. Shall be the custodian of The Christian Union’s constitution. 

 

B. The Office of the Vice Chairpersons 
i. Shall consist of the 1st and 2nd vice-chairperson. 
ii. If the chairperson is a male the first vice chair shall be female and if the 
chairperson is a female, then the first vice chairperson shall be a male. 
iii. The first and second vice chairpersons shall not be of the same gender. 
a) Roles of the Female Vice-Chairperson. 
i. Shall assist the Chairperson in his/her absence by performing duties of the 
Chairperson. 
ii. Shall be in charge of the ladies’ ministry. 
iii. Shall be in charge of the hospitality ministry. 
iv. Shall be in charge of the ladies’ discipline. 
v. Shall be in charge of the welfare of The Christian Union’s leaders. 
vi. Shall be a member of the Welfare Committee. 
b) Roles of the male Vice-Chairperson. 
i. Shall be in charge of the gents’ ministry. 
ii. Shall be in charge of the gents’ discipline. 
iii. Shall be a member of the Associates Committee. 
iv. Shall assist the Chairperson in the absence of the First Vice-Chairperson by 
performing the duties of the Chairperson. 
v. Shall organize leadership development forums and trainings for The Christian 
Union’s leaders. 
vi. Shall be a member of the Welfare Committee. 
vii. Shall be in charge of the special activities of The Christian Union. 
viii. Shall draft and/or oversee and coordinate the Friday and Sunday service programs 
to ensure effective time management. 
C. The Secretary 
i. Shall deal with all the correspondence of The Christian Union except those that 
fall to another office. 
ii. In case of urgent matters where the Executive Council cannot be consulted, the 
secretary shall consult the Chairperson and/or the 1st Vice-Chairperson. The 
decisions reached shall be subject to ratification or otherwise at the next Executive 
Council meeting. 
iii. The Secretary shall be a signatory of The CU’s bank account. 
iv. Shall be responsible for coordinating the speakers for the mid-week fellowship 
and Sunday services in conjunction with the Chairperson. 


 

Page 18 of 34 

 

v. Shall, in consultation with the Chairperson, issue notices conveying all Executive 
Council meetings and all general meetings of The CU and shall be responsible for 
keeping minutes of all such meetings. 
vi. Shall be responsible for keeping the register of all registered CU members and 
preservation of all records of The CU. 
vii. Shall help the vice secretary on handling The CU’s library as deemed necessary. 
D. The Vice-Secretary 
i. Shall be the principal assistant to the secretary of The Christian Union. 
ii. Shall be in charge of the library. 
iii. Shall be responsible for coordinating the speakers for the mid-week fellowship 
and Sunday services in conjunction with the Secretary. 
E. The Treasurer 
The Christian Union’s Treasurer: 
i. Shall receive and disburse, under the direction of the Executive Council all monies 
belonging to The CU. Shall receive receipts for monies disbursed and preserve 
vouchers for all monies paid by The CU. 
ii. Shall ensure that proper books of account of all monies received and paid by The 
CU are always written up, preserved and available for inspection. 
iii. Shall be a mandatory signatory to The CU’s bank account. 
iv. Shall keep records of all assets of The CU. 
v. Shall advise the Executive Council on the matters of financial status of The CU. 
vi. The Executive Council shall prepare a budget at the beginning of every semester 
after the committee and sub-committee treasurers have submitted their proposed 
budgets; thereafter the Treasurer shall compile the full budget. 
vii. Shall be a member of the Welfare Committee 
viii. Shall Oversee any fundraising as may be set from time to time. 
ix. Shall be the link between the auditing committee and the Executive Council. 

 

F. The Prayer Coordinator 
The Prayer Coordinator shall: 
i. Head the Prayer Committee and chair/convene all the committee meetings. 
ii. Endeavour to encourage The CU members to pray. 
iii. Handle all The CU’s Prayer Committee correspondence. 
G. The Music Coordinator 
i. Shall chair all of the Music Committee meetings. 
ii. Shall be the link between the Executive Council and the Music Committee. 
iii. Shall oversee the various ministries’ events and activities in the music ministry. 
H. The Missions and Evangelism Coordinator 
i. Shall be the chair to the Missions and Evangelism Committee. 


 

Page 19 of 34 

 

ii. Shall be the link between the Executive Council and the Missions and Evangelism 
Committee. 
iii. Shall be responsible for coordinating and overseeing all duties assigned to the 
Missions and Evangelism Committee. 

 

I. The Bible Study and Training Coordinator 

 

i. Chair the Bible Study & Training Committee. 
ii. Be the link between the Executive Council and the Bible Study and Training 
Committee. 
iii. Shall oversee all the activities in the Bible Study & Training Committee. 
J. The Discipleship Coordinator 

 

iv. Chair the Discipleship Committee. 
v. Be the link between the Executive Council and the Discipleship Committee. 
vi. Shall oversee all the activities in the Discipleship Committee. 
K. The Technical & Media Ministry Coordinator 

 

i. Shall Chair the Technical Committee. 
ii. Be the link between the Executive Council and the Technical & Media Ministry 
Committee 
iii. Shall oversee all the activities in the Technical and Media Ministry. 
L. The Creative Arts Ministry Coordinator 
i. Shall chair the Creative Committee meetings. 
ii. Shall be the link between the Executive Council and the Creative Committee. 
iii. Shall oversee all the Creative Ministry activities. 
iv. Shall coordinate and oversee Transformation and Advocacy campaigns in the 
Christian Union.  
Article 13: The Christian Union Committees 
13.1 General Committees 
The Christian Union shall have 9 committees for the specific ministries which shall be as 
herein stated: 
i. Treasury Committee 
ii. Hospitality Committee 
iii. Music Committee 
iv. Prayer Committee 
v. Missions and Evangelism Committee 
vi. Creative Arts Ministry Committee 


 

Page 20 of 34 

 

vii. Technical and Media Ministry Committee 
viii. Welfare Committee 
ix. Bible Study and Training Committee. 
x. Discipleship Committee 

 

13.2 Special Committees 
The Christian Union shall also have special committees which shall include the following and 
any other committee(s) appointed by the Executive Council: 
i. The Christian Union’s Advisory Board 
ii. The Christian Union’s Auditing Committee 
iii. Resource Mobilisation Committee 
iv. The Interim Executive Council 
13.3 The Office of the Patron 
Shall comprise of the CU’s Patron and the Assistant Patron. 
i. The Patron shall be a member of the MUT teaching staff or a senior administrator of 
Murang’a University of Technology and shall uphold the aims and doctrinal basis of 
The Christian Union. 
ii. The Executive Council shall appoint The Christian Union’s Patron (Female or Male) 
and an Assistant Patron (Female or Male) The Patrons shall serve for a period not 
exceeding 4 years unless their tenure of office is renewed and affirmed during the 
Annual General Meeting or Special General Meeting. 
iii. Together with the CU Chairperson, the patron(s) shall link and represent the C.U to 
the university administration. 
13.4 The Advisory Board 
A. Its functions will be to assist and advise the leadership and may engage in the events, 
functions or activities that can further the aims of the CU. 
B. The Advisory board shall be appointed by the Executive Council. The Committee 
shall serve for one spiritual year. 
C. A member and The Christian Union’s Associates representative may be re-appointed 
any number of times. 
D. The advisory board shall be mandated to meet at least once a spiritual year. 

 

Shall comprise of the following: 
i. The Patron 
Shall be the Chairperson and the convener of the committee.  
ii. Assistant patron 
Shall be the vice chairperson to the Advisory Board. 


 

Page 21 of 34 

 

iii. The Christian Union Chairperson 
 Shall be the Secretary of the Committee. 
iv. Two Associates of The Christian Union 
v. FOCUS staff. 
vi. Member - who ascribes to the Christian faith and who will uphold the aims and 
doctrinal basis of The Christian Union and shall not be a student. 

 

13.5 The Auditing Committee 
Shall comprise of:  
i. The 2 Internal auditors appointed by the Executive Council 
ii. The Christian Union’s Asset Manager 
13.5.1 Duties of the Auditing Committee 
The Auditing Committee shall: 
i. Audit and inspect all of The Christian Union’s books of accounts, assets and 
liabilities. 
ii. Reporting of all financial information regarding The Christian Union. 
iii. Protection of The Christian Union’s assets. 
iv. Facilitating for the independence of the External Auditor. 
v. Consider all of the significant matters that were raised during the audit process and 
advice The Christian Union as deemed relevant. 

 

13.6 The Resource Mobilization Committee 
13.6.1 Composition 
The committee shall be appointed by the Executive Council and shall consist of members 
who are creative, diligent, and have a passion for Kingdom Empowerment and Stewardship. 
The composition is as follows: 
1. Chairperson: A dedicated and committed member of The Christian Union that will 
provide strategic and transformational leadership to the committee. 
2. Secretary: Will be responsible of handling all communications, writing minutes of 
the meetings and record-keeping for the committee. 
3. Treasurer: Shall be responsible of managing the specific independent resources 
acquired by the committee. 
4. The Christian Union's Treasurer (Ex-officio): To provide financial guidance, 
oversee reports and ensure alignment with The Christian Union's overall financial 
management as per Article 9 (V). 


 

Page 22 of 34 

 

5. Associate Representative: A member from the Associates Committee (as per Article 
24) to act as a direct link to The Christian Union's Associate network. 
6. Three to Five (3-5) General Members: Full members of The Christian Union known 
for their integrity and innovative thinking preferably with interest or experience in 
fundraising, finance or partnerships. 
13.6.2 Roles and Responsibilities 
The primary mandate of the Resource Mobilization Committee shall be to plan, coordinate, 
implement, and oversee strategies for generating resources for The Christian Union. Its duties 
shall include: 
i. Strategic Plan Development: Formulating an annual or strategic time resource 
mobilization plan in consultation with the Executive Council, outlining targets, 
activities, and timelines. 
ii. Fundraising Initiatives: Planning, coordinating and executing all fundraising events, 
campaigns, and activities for The Christian Union. 
iii. Partnership and Donor Engagement: Identifying and cultivating relationships with 
potential and existing partners, including Associates, church partners, friends of The 
Christian Union and other well-wishers. 
iv. Proposal Writing: Drafting compelling proposals for specific projects presented to 
potential sponsors. 
v. Collaboration with the Executive Council: Working closely with the CU Treasurer 
and Executive Council to ensure all generated funds are properly documented and 
channeled, and with other committees to understand their financial needs. 
vi. Reporting: Providing regular, detailed reports on all fundraising activities to the 
Executive Council and a summary report for the Annual General Meeting (AGM). 
vii. Kingdom Financing Culture: Promote a culture of stewardship, generosity, and 
financial accountability within The Christian Union. 

 

 

 

 

 

 

 


 

Page 23 of 34 

 

CHAPTER 4:  THE CHRISTIAN UNION 
MEETINGS 
Article 14: Regular Meetings 
i. The Christian Union shall arrange for regular meetings as seen convenient; 
meetings shall include: Bible study, devotions, fellowships and services among 
others as the Executive Council determines from time to time. 
ii. The Executive Council shall meet at least once in a week on a convenient 
day with a quorum of not less than two thirds of all the members. 
iii. The Executive Council and all Sub Committees will meet together at least 
once a semester to discuss matters affecting The Christian Union. 

 

Article 15: General Meetings 
The Christian Union’s members and other admitted members of the general meeting 
shall have the right to participate in general meetings. 

 

There shall be two classes of general meetings; 
i. Annual General Meetings. 
ii. Special General Meetings. 
15.1 Annual General Meetings (AGM) 
i. Annual General Meetings shall be held between the sixth and the eighth week of the 
first semester of each spiritual year. 
ii. Notice of such Annual General Meetings and agenda for the meeting shall be passed 
to all members not less than 21 days before the date thereof. 
iii. The annual statement of account shall be provided to members on the material day of 
the Annual General Meeting. 
iv. The agenda of the Annual General Meeting shall consist of the following; 
a) Preliminaries 
b) Admission of non-members by The Christian Union’s Secretary 
c) Affirmation of The Christian Union’s doctrinal basis by either of The Christian 
Union’s Vice Chairpersons 
d) Reading and confirmation of the minutes of the previous Annual general meeting 
e) Reports of the outgoing Executive Council. 
f) Presentation of The Christian Union’s audited financial statements and reports 


 

Page 24 of 34 

 

g) Any other matters as the Executive Council may decide of which notice shall be given 
in writing by a member(s)to The Christian Union’s Secretary at least fourteen days to 
the date of the meeting 
h) Confirmation of the new Executive Council by the Nomination College chair 
i) Handing over of reports to the incoming Executive Council as overseen by the 
Nomination College chair 
j) Commissioning of the New Executive Council 
k) Any other business with the approval of the new chairperson of The Christian Union 
l) Adjournment of the meeting by the new Chairperson 
v. Quorum for Annual General Meeting shall not be less than 25 percent of the 
registered full members of The Christian Union. 
vi. In the event of the AGM failing to take place due to lack of quorum another meeting 
shall be convened in not less than 14 days and not more than 21 days. The quorum for 
this second meeting shall be such members as are present. 

 

15. 2 Special General Meeting 
i. May be called for any specific purpose by the Executive Council. The notice moved 
by full members of such meeting shall be passed to all members not less than 7 days 
before the date thereof. 
ii. An SGM may also be requisitioned for a specific purpose by order at least 25% of full 
membership in writing to the Secretary and such meeting shall be held within 21 days 
of such requisition. The notice for such meetings shall be 7 days, and no matter may 
be discussed at that meeting other than that stated in requisition. 
iii. Quorum for special General Meeting shall be 25 percent of full members of The 
Christian Union. 
iv. In the event of the SGM failing to take place due to lack of quorum another meeting 
shall be convened in not less than 14 days and not more than 21 days. The quorum for 
this second meeting shall be such members as are present. 
Article 16: Procedures at General Meetings 
i. The outgoing Chairperson shall chair the Annual General Meeting and Special 
General Meeting of The Christian Union. In his or her absence the outgoing 1st Vice 
Chairperson shall undertake the chairperson’s duties. In the absence of the above 
office bearers, the second vice chair shall chair the meeting. Under no circumstances 
may general meetings be held with all the three absent. 
ii. The chairperson in (a) above at his /her discretion may limit the number of persons 
permitted to speak in favour of or against any motion provided that both sides are 
equally represented. 
iii. Resolutions shall be decided by adopting a motion moved by a full member. 


 

Page 25 of 34 

 

CHAPTER 5: NOMINATIONS AND 
TRANSITIONS 
Article 17: Nomination College (NC) 
i. Nominations shall be conducted by the Nomination College which shall consist of 
12 finalists.  
ii. All the finalists in the Executive Council shall be members of the Nomination 
College. The rest of the members shall be drawn from The Christian Union’s 
ministries. 
iii. The Nomination College shall be formed Fourteen (14) days before nomination day. 

 

17.1 Duties of the Nomination College  
i. Shall, during their first meeting nominate the chairperson and secretary of the 
commission. 
ii. Shall lead the nominations exercise by the CU members during a Sunday Service. 
iii. Shall prepare the materials for nomination, and issue them to the CU members and 
oversee the nomination process.  
iv. Shall sensitize CU members before and during the nominations. 
v. Shall make the final appointment for each of the offices of the executive council and 
other leadership positions as guided by the leadership manual.  
vi. Shall ensure that all offices whose appointments turndown the office are successfully 
replaced before the AGM. 
vii. Shall handle objections to any nominated member and take appropriate measures over 
such cases before the AGM. 
17.2 Nomination Process 
i. The nominations shall be held at-least 3 weeks before the AGM. 
ii. The CU members shall be notified at least one week before the nomination exercise 
for prayer, fasting and meditation concerning the new Christian Union leadership. 
iii. The full members of The Union shall be asked to recommend in writing to the 
Nomination College; persons they have prayerfully felt should form the next 
Executive Council in a general meeting. 
iv. The Nomination College shall make final nominations for each of the offices of the 
Executive Council before the AGM. Names of the nominees will be made known to 
the members of The Union at least two (2) weeks before the AGM for a prayerful 
consideration. 
v. Objections to any of the candidates nominated by the Nomination College must 
be made in writing and should reach the Secretary of the Nomination College at 
least seven (7) days before the AGM. Such objections can only be made by full 
members. 


 

Page 26 of 34 

 

vi. Any substitution of the nominees shall be considered and made by the Nomination 
College as in (v) above. 

 

17.3 Nomination of Committees 
The sub committee leaders shall be appointed within fourteen (14) days after the AGM by the 
Executive Council together with the Nomination College. 
17.4 Orientation and Handing Over 
i. The Nomination College shall be responsible for smooth transition and handing over. 
ii. The new office bearers shall be dedicated to the Lord’s service during the AGM upon 
ratification.  
iii. The outgoing office bearers shall orient the incoming office bearer on all matters 
concerning their office.  
iv. The outgoing office bearers shall officially handover all documents pertaining to their 
offices.  
v. A report showing all that has been handed over will be signed by both the outgoing 
and the incoming office bearers, upon reception of the same by the new office bearers. 
vi. Official induction and orientation shall be done within three weeks of entering office. 
Article 18: By- Nominations 
18.1 Vacation of Office 
An office shall be declared vacant under the following circumstances: 
i. If a vote of no confidence is passed against an Executive Council member by at least 
2/3 of the full members present in a special general meeting. 
ii. Demise. 
iii. Incapacitation due to illness. 
iv. Gross misconduct. 
v. Ineffectiveness in meeting their duties. 
vi. Neglect of responsibilities 
vii. Resignation by the Leader. 
viii. Deferment and change of institution. 
Article 18.2: Procedure for Filling Vacancies 
In the event that a vacancy arises on the Executive Council under the circumstances listed 
in Article 18.1: 
1. Formation of By-Nomination Committee: 
i. The Executive Council shall, within seven (7) days of the vacancy, exercise its 
power under Article 12.2 (iii) to appoint a temporary By-Nomination college 
guided by article 17. 


 

Page 27 of 34 

 

ii. This committee shall consist of five (5) full members who are not current 
members of the Executive Council. 
iii. The Executive Council shall appoint one of the by-nomination college 
members to act as the Chairperson of this committee. 
The sole mandate of the By-Nomination College shall be to oversee the nomination 
and appointment of a qualified member to fill the specific Executive Council vacancy. 
2. Nomination Process: The By-Nomination College shall follow the procedure 
outlined in Article 17.2, adapted for the vacancy. This shall include: 
i. Notifying the CU members for prayer, fasting, and meditation concerning the 
vacancy. 
ii. Asking full members to recommend, in writing, persons they have prayerfully 
felt should fill the vacancy. 
iii. Vetting the recommendations and ensuring all candidates meet the eligibility 
requirements of Article 12.4. 
iv. Making the final nomination for the vacant office. 
3. Presentation and Objections: 
i. The name of the nominee shall be made known to the members of the Union 
at least seven (7) days before their confirmation for prayerful consideration. 
ii. Objections to the candidate must be made in writing by full members to the 
Chairperson of the By-Nomination College within a 3 days period. 
4. Appointment and Term: 
i. The By-Nomination College shall consider any objections and make a final 
decision on the appointment. 
ii. The newly appointed member shall be presented and commissioned at the next 
convenient regular CU meeting. 
iii. The appointed member shall serve for the remainder of the spiritual year. 
5. Dissolution: Upon the successful appointment of the new member, the By-
Nomination College shall be dissolved by the Executive Council after 7 days. 

 

 

 

 

 


 

Page 28 of 34 

 

CHAPTER 6:  FUNDS,ASSETS AND THEIR 
ADMINISTRATION 
Article 19: Inspection of accounts and list of members 
The books of accounts, all documents relating thereof and list of Members of The Christian 
Union shall be available for inspection at the registered office of The Christian Union by any 
member of The Christian Union or any officer on giving not less than seven (7) days’ notice 
in writing to the Executive Council through the secretary. 
Article 20: Funds and their administration 
i. The funds of The Christian Union shall be used for the purpose which the Executive 
Council considers proper in accordance to the aims of The Christian Union.  
ii. Any funds received by The Christian Union shall be deposited directly into The 
Christian Union's official bank account(s) or through The Christian Union's Treasurer. 
When He/she handles cash deposits, the transaction shall be conducted with the 
presence and signature of at least one other committee treasurer. 
iii. All Committees or ministries that handle any money shall have a treasurer who will 
keep proper records and shall report to the Executive Council treasurer. 
iv. No payment shall be made out of the bank account without the resolution of 
the Executive Council authorizing payments. Such authorization shall be 
signed by any two (2) of the following five persons (signatories): treasurer, 
chairperson, vice chairperson, secretary or vice-secretary. 
v. Signatories to the bank account shall include: The Treasurer, Chairperson 
and Secretary to the Executive Council. Any withdrawal from the bank 
account shall require signatures of at least two of the above persons. 
vi. A sum of money approved by the Executive Council shall be kept by the treasurer for 
petty cash disbursement. 
vii. The financial year for The Christian Union shall run from 1st September to 31st 
August. 
Article 21: Auditing 
The Christian Union shall have two categories of auditors: 
a) The CU Internal Auditing Committee and 
b) External auditor. 
i. The auditors shall be appointed by the Executive Council for that spiritual year. 
ii. The external auditor shall neither be an office bearer nor a member of The CU. The 
internal auditor must not be an office bearer but must be a member of The CU who 
has knowledge in auditing and assurance. 
iii. The external auditor shall be a qualified CPA (K). 


 

Page 29 of 34 

 

iv. All of The CU’s accounts, records, and documents shall be open for inspection by the 
two auditors before the Annual General Meetings. The treasurer shall give an account 
for the receipts; payments and a statement of assets and liabilities made up to date and 
certified that they are correct and duly vouchered at the end of the spiritual year. 
v. A copy of the auditor’s report on the accounts and statements shall be furnished to all 
members by the date of the Annual General Meeting. An auditor is appreciated by 
such honorarium for his/her duties as may be resolved by the Executive Council 
appointing him/her. 
Article 22: The Christian Union’s Assets 
i. Without prejudice and pursuant to the powers conferred upon the Executive Council 
and the assets manager, no equipment shall be leased, rent, lent out, unless the assets 
manager with the approval of the Executive Council owing to the evident and 
compelling reason(s) deem(s) it necessary. 
ii. The equipment shall be used as per The Union’s assets policy. 
iii. Disposal of The Union’s assets should be done to the bidder with the highest offer. 
iv. Purchase of The Union’s assets should be from the bidder offering the best quality at 
the lowest price. 
v. Any loss of assets shall be handled by the asset’s manager and the Executive Council. 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

Page 30 of 34 

 

CHAPTER 7: DISSOLUTION, AMENDMENTS 
AND REVIEW OF THE CONSTITUTION  
Article 23: Procedure of amendments 
No amendments shall be made to this constitution unless; 
i. At least 42 days’ notice in writing of any proposed amendments shall be given to the 
Secretary of The Christian Union who shall thereafter give at least 28 days’ notice to 
the members of the AGM/SGM 
ii. The opinion of the FOCUS staff and advisory board shall be sought and 
recommendation made known to the general meeting. 
iii. The amendment is passed by two thirds (2/3) of full members present through voting 
at an SGM/AGM. 
iv. The proposed amendments to this constitution are made by only full members who 
are eligible for the same. 

 

Article 24: Constitution Review Process 
i. Setting up of an amendment commission herein after referred to as Constitution 
Review Commission (C.R.C) which shall consist of seven members appointed by The 
Executive Council 42 days before the SGM/AGM.  
ii. The C.R.C may co-opt other members who shall not be more than three to represent 
some Christian Union’s special interests.  
iii. Its quorum shall not be less than 2/3 of the commissioners. 
iv. Members shall make proposals to the C.R.C within a period of 14 days. 
v. The constitution review commission shall analyse proposals and with the advice of 
the Advisory Board come up with the proposed constitution. The proposed 
constitution shall be presented to The Christian Union members 14 days to 
S.G.M/A.G.M.  
vi. The constitution shall from then henceforth be operational. 
vii. The entire constitution shall be reviewed after three calendar years. 
Article 25: Dissolution 
i. Union shall not be dissolved except by a resolution passed at a General Meeting of the 
members by votes of three quarters (3/4) of the full members present. If there is 
insufficient quorum, the proposal to dissolve The Christian Union shall be postponed 
to a further general meeting to be held four weeks later. Notice of this meeting shall 
be given to all members of The Christian Union at least 14 days before the date of the 
meeting. The quorum for this second meeting shall be the number of members 
present. 


 

Page 31 of 34 

 

ii. Provided, however, that no dissolution shall be affected without the prior permission 
of the University Dean of Students obtained upon application to him/her made in 
writing and signed by at least three of the office bearers. 
iii. When the dissolution of The Christian Union has been approved by the Dean of 
Students, no further action shall be taken by the Executive Council than to liquidate 
all assets of The CU subject to the payment of debts of The Christian Union, the 
balance thereof being paid to any Christian organization(s) as may be resolved by the 
meeting at which the resolution for dissolution was passed. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

Page 32 of 34 

 

CHAPTER 8: GENERAL PROVISIONS  

 

Article 26: Partnerships 
i. The Executive Council on behalf of MUTCU shall have the right to control or limit as 
need be any activity or partnership deemed to be subversive to the objectives and 
doctrinal basis of the union.  
ii. The MUTCU shall partner with other bodies or organizations within and outside the 
university upholding the same objectives and doctrinal basis according to the 
partnership policy.  
26.1 Partnership Guidelines  
i. The MUTCU shall have short- and long-term partnership with possibility of extension 
after review and evaluation.  
ii. All partnership shall be carefully considered to protect the interdenominational nature 
of the MUTCU.  
iii. All MUTCU partnership documents shall be filed for reference due to the transitory 
nature of the MUTCU leadership.  
Upon violation of any partnership agreement the following steps shall be followed:  
i. A meeting of the two partners inclusive of the guarantors shall be held to discuss the 
violated agreement.  
ii. Upon discussion, the partnership shall be given a second chance with 
recommendations. 
iii. Termination of partnership which shall involve official signing by the partners and the 
guarantors.  
iv. In case of termination, communication shall be made to the MUTCU members by the 
chairperson.  
v. Other partnership guidelines shall be adhered to as stipulated in the partnership policy. 

 

Article 27: Associates Committee 
There shall be an Associates Committee consisting of the following: 
i. The Chairperson, 
ii. The Secretary, 
iii. The treasurer 
iv. The male Vice Chairperson of The Christian Union 
 All the above members shall be members of The Christian Union. 

 


 

Page 33 of 34 

 

27.1 Duties of the Associates Committee 
Shall have the following duties: 
i. Keep the link with The Christian Union’s Associates. 
ii. Maintain a record of the Associate ’s database. 
iii. Organize the Associate ’s weekend. 
iv. The four executive appointees shall be responsible of regular Committees’ activities. 
Article 28: Dispute Resolution  
In the event of a dispute regarding the interpretation of this constitution or conflicts between 
ministries that cannot be resolved by the concerned parties, the matter shall be referred to the 
Executive Council for mediation. If a resolution is not reached, the matter shall be escalated 
to the Advisory board for a final and binding decision. 
Article 29: Official Communication  
Official notices for meetings, nominations, and other formal announcements shall be 
communicated via memo to members through the Secretaries via official Christian Union 
designated digital platforms. Communication through these channels shall be deemed to have 
been duly served. 
Article 30: Definition of terms  
In this Constitution, unless the context otherwise requires: 
i. 'MUTCU' or 'The Christian Union (C.U.)' refers to the Murang'a University of 
Technology Christian Union. 
ii. 'AGM' refers to the Annual General Meeting. 
iii. 'SGM' refers to a Special General Meeting. 
iv. 'NC' refers to the Nomination College responsible for overseeing nominations. 
v. 'C.R.C' refers to the Constitution Review Commission. 
vi. 'FOCUS Kenya' refers to the Fellowship of Christian Unions, the national umbrella 
body to which MUTCU is affiliated for guidance and partnership. 
vii. 'Spiritual Year' refers to the period from the conclusion of one Annual General 
Meeting to the conclusion of the next. 
viii. 'Bona Fide Student' refers to an individual officially registered for a course of study 
at Murang'a University of Technology for the current academic year. 
ix. 'Executive Council' refers to the principal governing body of the Christian Union as 
outlined in Article 12. 


 

Page 34 of 34 

 

x. 'General Meeting' refers to either an Annual General Meeting (AGM) or a Special 
General Meeting (SGM). 
xi. 'Patron' refers to a member of the University teaching or administrative staff who 
serves as an advisor and liaison to the University. 
xii. 'Ex-officio' refers to a member of a committee who serves by virtue of holding 
another office. 
xiii. 'Quorum' refers to the minimum number of members that must be present at a 
meeting for its proceedings to be valid. 
Article 31: Supremacy and Application  
This constitution shall be subject to the rules and regulations of the Murang'a University of 
Technology and the laws of the Republic of Kenya. Where any provision of this constitution 
conflicts with university regulations or national law, the latter shall prevail. 
Article 32: Appendices  
The Executive Council may maintain appendices to this constitution, which shall contain 
supplementary policies and procedures. These appendices shall be consistent with the 
provisions of this constitution and can be amended by a two-thirds resolution of the 
Executive Council. The appendices may include, but are not limited to: 
i. Appendix A: Leadership Manual 
ii. Appendix B: Policy framework 
iii. Appendix C: MUTCU Brand guidelines 

 MURANG’A UNIVERSITY OF TECHNOLOGY CHRISTIAN UNION 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

Leadership Manual, 2025. 

 

 

 

 

 

Inspire Love, Hope & Godliness 
© 2025 Murang'a University of Technology Christian Union (MUTCU). All rights reserved. 

 

 


 

2 | P a g e 

 

Introduction 
Purpose of This Manual 
This Leadership Manual is the official operational guide for all leaders within the Murang'a 
University of Technology Christian Union (MUTCU). It is a companion document to the 
MUTCU Constitution. While the Constitution provides the high-level governance structure, 
authority, and foundational principles, this manual breaks down the composition, specific 
duties, responsibilities, and expectations for every leadership position. 
Its purpose is to: 
1. Provide Clarity: To give every leader a clear and detailed understanding of their 
roles, responsibilities, and the expectations of their office, ensuring they are well-
equipped to serve effectively. 
2. Ensure Consistency: To establish a unified understanding of roles across all 
ministries, ensuring they function harmoniously and towards the common vision of 
the Christian Union. 
3. Promote Accountability: To serve as a benchmark for performance and ethical 
conduct, fostering a culture of responsibility, integrity, and servant leadership. 
4. Facilitate Smooth Transitions: To be a primary resource for orienting new leaders, 
ensuring the continuity of ministry and the overall health of the CU from one spiritual 
year to the next. 
Every leader is expected to be thoroughly familiar with the contents of this manual and to 
conduct their ministry in accordance with its guidelines, all while remaining submitted to the 
supreme authority of the Holy Bible and the MUTCU Constitution. 

 

 

 

 

 

 

 

 

 

 

 

 


 

3 | P a g e 

 

Table of Contents 
Part 1: Foundational Principles for All Leaders ................................................................................ 5 
1.1 Vision, Mission, and Core Values .............................................................................................. 5 
1.2 General Code of Conduct for Leaders ...................................................................................... 5 
Part 1.3: Leadership Qualifications & Appointment Process ........................................................... 6 
A. The Biblical Qualifications for Leadership ................................................................................ 6 
B. Constitutional Eligibility for Leadership ................................................................................... 7 
C. The Leadership Appointment Process (Art 17) ......................................................................... 7 
Part 2: The Executive Council: Roles & Responsibilities .................................................................. 9 
2.1 The Chairperson ......................................................................................................................... 9 
2.2 The First Vice Chairperson (Female) ........................................................................................ 9 
2.3 The Second Vice Chairperson (Male) ....................................................................................... 9 
2.4 The Secretary ............................................................................................................................ 10 
2.5 The Vice-Secretary .................................................................................................................... 10 
2.6 The Treasurer ............................................................................................................................ 10 
2.7 The Prayer Coordinator ........................................................................................................... 11 
2.8 The Music Coordinator ............................................................................................................ 11 
2.9 The Missions and Evangelism Coordinator ............................................................................ 11 
2.10 The Bible Study and Training Coordinator ......................................................................... 12 
2.11 The Discipleship Coordinator ................................................................................................ 12 
2.12 The Technical and Media Ministry Coordinator ................................................................. 12 
2.13 The Creative Arts Ministry Coordinator .............................................................................. 12 
Part 3: General Committees & Ministries: Structure and Roles.................................................... 14 
3.1 Treasury Committee ................................................................................................................. 14 
3.2 Hospitality Committee .............................................................................................................. 15 
3.3 Music Committee ...................................................................................................................... 16 
3.4 Prayer Committee ..................................................................................................................... 18 
3.5 Missions and Evangelism Committee ...................................................................................... 19 
3.6 Creative Arts Ministry Committee .............................................................................................. 22 
3.7 Technical and Media Ministry Committee ................................................................................. 24 
3.8 Welfare Committee ....................................................................................................................... 27 
3.9 Bible Study and Training Committee ......................................................................................... 29 
3.10 Discipleship Committee .............................................................................................................. 31 
Part 3: General Committees & Ministries Roles .............................................................................. 34 
3.1 Treasury Committee ................................................................................................................. 34 
3.2 Hospitality Committee .............................................................................................................. 35 
3.3 Music Committee ...................................................................................................................... 35 


 

4 | P a g e 

 

3.4 Prayer Committee ..................................................................................................................... 35 
3.5 Missions and Evangelism Committee ...................................................................................... 35 
3.6 Creative Arts Ministry Committee .......................................................................................... 36 
3.7 Technical and Media Ministry Committee ............................................................................. 36 
3.8 Welfare Committee ................................................................................................................... 36 
3.9 Bible Study and Training Committee ..................................................................................... 36 
3.10 Discipleship Committee .......................................................................................................... 37 
Part 4: Special Committees: Mandate, Composition & Roles ........................................................ 38 
4.1 The Advisory Board .................................................................................................................. 38 
4.2 The Auditing Committee .......................................................................................................... 39 
4.3 Resource Mobilization Committee (RMC) ............................................................................. 40 
4.4 The Associates Committee (Alumni) ....................................................................................... 41 
4.5 The Interim Executive Council (May-August Session) .......................................................... 41 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

5 | P a g e 

 

Part 1: Foundational Principles for All 
Leaders 
1.1 Vision, Mission, and Core Values 
a) Vision Statement: To be a model Christian union that cultivates Christ-centeredness 
among members to positively impact the society. 
b) Mission Statement: Raising a Christ-like family, equipped in all aspects of life, by 
encouraging unity as one body and reaching out to non-believers within our 
community and beyond. 
c) Core Values: 
i. Faith. 
ii. Love. 
iii. Hope. 
iv. Godliness. 
v. Accountability. 
vi. Service. 
1.2 General Code of Conduct for Leaders 
1. Spiritual Life: Every leader must be committed to personal spiritual growth through 
prayer, Bible study, and active fellowship. This is the foundation of their service. 
2. Ethical Conduct: All leaders are expected to be ethical, demonstrating integrity, 
honesty, and moral purity in all engagements, serving as a Christ-like example to the 
CU and the wider university community. 
3. Discipline and Order: Leaders must maintain a high order of discipline, punctuality, 
and respect in all meetings and activities, valuing the time and contributions of others. 
4. Task Completion: Any member assigned a task must complete it diligently and 
submit their report before the specified deadline, reflecting a commitment to 
excellence and accountability. 
5. Confidentiality: Leaders must handle sensitive information concerning members or 
the Union's affairs with the utmost confidentiality and pastoral care. 

 

 


 

6 | P a g e 

 

Part 1.3: Leadership Qualifications & 
Appointment Process 
This section outlines the spiritual, personal, and practical qualifications required for all 
leaders in MUTCU, and the process by which they are appointed, as grounded in the Holy 
Bible and the MUTCU Constitution. 
A. The Biblical Qualifications for Leadership 
The foundation of leadership in the Christian Union is not skill, popularity, or ambition, but 
proven Christian character. We derive our qualifications from the standards set for overseers 
in Scripture. 
1. Based on Titus 1:7-9: 
A leader in MUTCU must be: 
i. Blameless (Above Reproach): Their life is lived with integrity, free from patterns of 
sin or public scandal that would bring disrepute to the gospel. 
ii. Humble and Gentle: Not "overbearing" or "quick-tempered." They must be 
teachable, patient, and able to handle conflict without arrogance or anger. 
iii. Self-Controlled: Not "given to drunkenness," "violent," or "pursuing dishonest gain." 
They must demonstrate discipline over their body, actions, and desires, including 
managing their finances with integrity. 
iv. Hospitable and Good: "Hospitable" and "one who loves what is good." They should 
be welcoming, generous, and actively pursuing righteousness. 
v. Upright, Holy, and Disciplined: They are committed to a life of personal holiness, 
fairness in their dealings, and spiritual discipline. 
vi. Grounded in the Word: They must "hold firmly to the trustworthy message as it has 
been taught, so that they can encourage others by sound doctrine and refute those who 
oppose it." A leader's primary tool is the Word of God. 

 

2. Based on Acts 1:21-26: 
When the apostles replaced Judas, their criteria provide a model for our context: 

i. Proven Faithfulness: They looked for those who had "been with us the whole time... 
from John's baptism to the time when Jesus was taken up." 


 

7 | P a g e 

 

A leader must be a person of proven faithfulness, consistency, and active participation. They 
must be known to the fellowship, have a track record of service, and be a regular participant 
in the CU's core activities (services, prayer meetings, Bible studies). 
ii. Devoted to Prayer: The entire process was saturated in prayer, and they "cast lots" 
(an act of trusting God's sovereignty) after they had prayed. 
A leader must have a demonstrably active personal prayer life, and the appointment process 
itself must be rooted in corporate prayer, not just human opinion. 
B. Constitutional Eligibility for Leadership 
In addition to the biblical qualifications, a candidate for leadership must meet the practical 
requirements set by the MUTCU Constitution: 

For Executive Council (Art 12.4): 
1. Must be a Full Member of the CU (as per Art 8.2.I). 
2. Must have completed one full academic year (i.e., not a first-year student). 
3. Must not be a finalist (i.e., must be a student by the time of the next AGM). 
4. Must meet the Biblical Qualifications outlined in this manual. 
5. Must not hold an executive post in the university students' council (Art 11). 
For General Committee/Ministry Leaders: 
1. Must be a Full Member of the CU. 
2. Must demonstrate the Biblical Qualifications (Section A). 
3. Must be an active and faithful participant in the life of the CU. 
4. Must uphold the MUTCU doctrinal basis. 
C. The Leadership Appointment Process (Art 17) 
The process of appointing new leaders is a spiritual responsibility shared by the entire Union, 
guided by the Nomination College. It is designed to reflect the principles of prayer and 
community witness seen in Acts. 
1. Step 1: Prayer & Sensitization 
i. The CU is notified at least one week before nominations for a period of 
prayer, fasting, and meditation (Art 17.2.ii). This aligns with Acts 1:24, where 
the community first prayed to the Lord, "who knows everyone's heart." 
2. Step 2: Member Recommendation 
i. Full members recommend in writing "persons they have prayerfully felt" 
should lead (Art 17.2.iii). This is the community's testimony, reflecting the 


 

8 | P a g e 

 

principle from Acts 1:21-22—identifying those who have been faithful and 
consistent. 
3. Step 3: Vetting & Nomination 
i. The Nomination College (comprised of finalists/elders) prayerfully vets the 
recommendations. 
ii. They check candidates against the Constitutional Eligibility (Section B) and, 
most importantly, the Biblical Qualifications (Section A). 
iii. The College then makes the final nominations (Art 17.1.v). 
4. Step 4: Presentation & Confirmation 
i. The names of nominees are presented to the Union at least two weeks before 
the AGM for prayerful consideration (Art 17.2.iv). 
ii. This period allows members to affirm the nominations or raise objections in 
writing (Art 17.2.v), ensuring accountability. 
5. Step 5: Commissioning 
i. After resolving any objections, the new executive council leaders are 
confirmed, dedicated, and commissioned to the Lord's service during the 
AGM (Art 17.4.ii). 

 

 

 

 

 

 

 

 

 


 

9 | P a g e 

 

Part 2: The Executive Council: Roles & 
Responsibilities 
2.1 The Chairperson 
1. Shall provide spiritual oversight and strategic direction to the Christian Union, 
ensuring all activities align with the vision and mission. 
2. Shall convene and preside over all Executive Council, Annual General, and Special 
General Meetings with fairness and order. 
3. Shall be the official spokesperson and primary representative of the CU to the 
university administration, FOCUS Kenya, and other external bodies. 
4. Shall serve as a mandatory signatory to the Union’s bank account(s), ensuring 
financial accountability. 
5. Shall oversee leadership development initiatives, ensuring all leaders are equipped 
and mentored for their roles. 
6. Shall act as the Secretary to the CU’s Advisory Committee, facilitating effective 
communication and meetings. 
7. Shall dissolve the Electoral Commission 21 days after the AGM 
8. Shall disband the acting Executive Council upon handing over to the initial 
office bearers. 
9. Shall be the custodian of the MUTCU Constitution. 

 

2.2 The First Vice Chairperson (Female) 
1. Shall assist the Chairperson in their duties and act in their full capacity during their 
absence, ensuring seamless leadership continuity. 
2. Shall provide executive oversight for the Ladies' Ministry, championing programs that 
cater to the unique spiritual, emotional, and social needs of female members. 
3. Shall provide executive oversight for the Hospitality Committee, cultivating a culture 
of genuine warmth, welcome, and care within the CU. 
4. Shall be directly responsible for the general welfare and pastoral care of all CU 
leaders, fostering unity and mutual support within the leadership team. 
2.3 The Second Vice Chairperson (Male) 
1. Shall assist the Chairperson in the absence of the First Vice-Chairperson. 
2. Shall provide executive oversight for the Gents' Ministry, fostering spiritual growth, 
brotherhood, and accountability among male members. 


 

10 | P a g e 

 

3. Shall serve as the Chairperson of the Welfare Committee, providing strategic 
direction and oversight to all its functions. 
4. Shall be the custodian of the Leadership Manual, ensuring their provisions are 
understood and upheld by all leaders. 
5. Shall draft and coordinate the programs for Friday and Sunday services, working with 
all relevant ministries to ensure services are impactful, edifying, and well-managed. 
6. Shall organize leadership development forums and trainings for The Union’s leaders. 
7. Shall be in charge of the special activities of The Union. 

 

2.4 The Secretary 
1. Shall manage all official correspondence of the Christian Union, acting as the central 
point for internal and external communication. 
2. Shall be responsible for recording, distributing, and archiving the official minutes of 
all Executive Council and General Meetings. 
3. Shall maintain the official register of all CU members and other key institutional 
records, ensuring data accuracy and integrity. 
4. In case of urgent matters where the Executive Council cannot be consulted, the 
secretary shall consult the Chairperson and/or the 1st Vice-Chairperson. The 
decisions reached shall be subject to ratification or otherwise at the next 
Executive Council meeting. 

 

5. Shall coordinate with the Chairperson to officially invite and confirm guest speakers 
for fellowships and services. 
6. Shall serve as a mandatory signatory to the CU’s bank account. 
7. Shall help the vice secretary on handling The Union’s library as deemed necessary. 

 

2.5 The Vice-Secretary 
1. Shall be the principal assistant to the Secretary, performing their duties in their 
absence and supporting all secretarial functions. 
2. Shall be directly responsible for the management, development, and day-to-day 
operations of the CU Library. 
3. Shall assist the Secretary in handling the logistical aspects of coordinating with guest 
speakers, such as follow-ups and information sharing. 

 

2.6 The Treasurer 
1. Shall be the chief financial officer of the Christian Union, providing oversight and 
ensuring the stewardship of all financial resources. 


 

11 | P a g e 

 

2. Shall receive and disburse all funds under the direction of the Executive Council, 
adhering strictly to approved budgets and financial policies. 
3. Shall maintain accurate, transparent, and up-to-date books of accounts using proper 
accounting procedures. 
4. Shall prepare and present comprehensive semesterly and annual financial reports to 
the Executive Council and the AGM. 
5. Shall serve as a mandatory signatory to the CU’s bank account. 
6. Shall maintain the CU’s official asset register in collaboration with the Asset 
Manager. 
7. Shall serve as an ex-officio member of the Welfare and Resource Mobilization 
Committees to provide essential financial guidance. 
8. Shall be a member of the Welfare Committee 
9. Shall be the link between the auditing committee and the Executive Council. 

 

2.7 The Prayer Coordinator 
1. Shall provide executive oversight and spiritual direction for the Prayer Committee. 
2. Shall be the lead champion for cultivating a culture of prayer throughout the entire 
Christian Union. 
3. Shall be responsible for the strategic planning and coordination of all corporate prayer 
meetings, prayer weeks, fasts, and other prayer-focused events. 
2.8 The Music Coordinator 
1. Shall provide executive oversight and spiritual leadership for the Music Committee 
and all its sub-ministries. 
2. Shall be responsible for ensuring the overall quality, theological depth, and doctrinal 
soundness of musical worship in the CU. 
3. Shall act as the primary link between the music teams and the Executive Council, 
representing their needs and providing guidance. 
2.9 The Missions and Evangelism Coordinator 
1. Shall provide executive oversight and strategic direction for the Missions and 
Evangelism Committee. 
2. Shall develop, implement, and evaluate the CU's overall strategy for outreach, both on 
and off campus. 
3. Shall ensure all outreach teams are well-trained, adequately resourced, and firmly 
aligned with the CU's doctrinal basis. 


 

12 | P a g e 

 

2.10 The Bible Study and Training Coordinator 
1. Shall provide oversight and educational leadership for the Bible Study and Training 
Committee. 
2. Shall be responsible for the overall strategy and health of the CU's small group Bible 
studies. 
3. Shall oversee the BEST-P (Bible Exposition Self Training Program) and ensure its 
effective administration. 
4. Shall champion a culture of consistent, personal Bible reading among members. 
5. Shall be the link between the Executive Council and the Bible Study and Training 
Committee. 
2.11 The Discipleship Coordinator 
1. Shall provide oversight and spiritual direction for the Discipleship Committee. 
2. Shall be responsible for developing and maintaining a comprehensive spiritual growth 
pathway for all members, from new believers to mature disciples. 
3. Shall oversee the Nurturing classes for new believers, ensuring they are effectively 
integrated into the CU. 
4. Shall provide guidance and support to the Years' Fellowships and Accountability 
groups. 
5. Shall be the link between the Executive Council and the Discipleship Committee. 
2.12 The Technical and Media Ministry Coordinator 
1. Shall provide executive oversight and technical direction for the Technical and Media 
Ministry Committee and all its sub-ministries. 
2. Shall be responsible for ensuring all technical aspects of CU services and events 
(including sound, visuals, and media production) are executed with excellence. 
3. Shall oversee the CU’s digital footprint and brand identity across all platforms, 
ensuring a consistent and positive online presence. 
2.13 The Creative Arts Ministry Coordinator 
1. Shall provide executive oversight and artistic direction for the Creative Arts Ministry 
Committee. 
2. Shall champion the use of creative arts as a powerful tool for worship, evangelism, 
and edification within the CU. 


 

13 | P a g e 

 

3. Shall oversee and mentor all creative teams, including drama, dance, spoken word, 
and modelling, ensuring their ministrations are both excellent and biblically sound. 
4. Shall coordinate and oversee Transformation and Advocacy campaigns in the 
Christian Union. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

14 | P a g e 

 

Part 3: General Committees & Ministries: 
Structure and Roles 
3.1 Treasury Committee 
1. Mandate: 
To ensure financial integrity, accountability, and proper management of all CU funds 
in support of the CU Treasurer. 
2. Committee Composition: 
i. The CU Treasurer (Chairperson) 
ii. Treasurers from all other General Committees. 
iii. The Asset Manager 
3. Roles of the Committee Office Bearers: 
A. Chairperson (CU Treasurer): 
i. Shall convene and chair all Treasury Committee meetings. 
ii. Shall provide training and guidance to all committee treasurers on 
financial procedures, budgeting, and reporting. 
iii. Shall harmonize all ministerial budgets into a single, comprehensive 
CU budget for Executive Council approval and management. 
B. Committee Treasurers (Members): 
i. Shall prepare, propose, and manage the budget for their respective 
committees under the guidance of their chairperson. 
ii. Shall be responsible for all financial record-keeping within their 
committee, including tracking expenses and collecting receipts. 
iii. Shall ensure all financial requests and accountabilities from their 
committee are handled according to the CU's financial policies. 
iv. Shall count and bank all of The Christian Union’s monies. 
C. The Asset Manager 
Shall ensure the proper valuation and maintenance of all CU assets. 

 

 

 

 


 

15 | P a g e 

 

3.2 Hospitality Committee 
1. Mandate: 
To model the love of Christ by creating a welcoming environment, caring for guests 
and members, and managing the CU office resources. 
2. Committee Composition: 
i. First Vice-Chairperson (Female) (Chairperson) 
ii. Hospitality Leader, 
iii. Secretary/Treasurer. 
iv. Two members 
3. Roles of the Committee Office Bearers: 
A. Chairperson (First Vice-Chairperson): 
i. Shall provide overall leadership and spiritual oversight to the 
committee. 
ii. Shall oversee the strategic planning and execution of all hospitality 
functions, including guest reception and new member integration. 
B. Hospitality Leader: 
i. Shall be the principal operational assistant to the Chairperson. 
ii. Shall coordinate the day-to-day activities of the hospitality team, 
including visitor care, serving refreshments, and following up with 
new members. 
iii. Shall be responsible for recruiting, training, and scheduling hospitality 
team volunteers for all services and events. 
C. Secretary/Treasurer: 
i. Shall take and maintain minutes for all committee meetings. 
ii. Shall manage the hospitality budget, which includes purchasing 
foodstuffs and maintaining an accurate inventory of office utensils and 
supplies. 
iii. Shall keep all financial and administrative records for the committee. 
D. Members: 
i. Shall undertake and support in any responsibilities as deemed necessary 
by the committee. 

 

 


 

16 | P a g e 

 

3.3 Music Committee 
1. Mandate: 
To lead the congregation in authentic, biblical, and excellent worship through music. 
2. Committee Composition: 
i. Music Coordinator (Chairperson) 
ii. Secretary/Treasurer 
iii. Sub-Ministry Coordinators 
3. Roles of the Committee Office Bearers: 
A. Chairperson (Music Coordinator): 
i. Provides spiritual and artistic direction for the entire music ministry. 
ii. Chairs all Music Committee meetings and coordinates the overall 
music schedule for CU services. 
iii. Organizes joint training and spiritual development sessions for all 
music teams. 
B. Secretary/ Treasurer: 
i. Handles all administrative tasks, including minutes, communication, 
and maintaining a database of ministry members. 
ii. Coordinates schedules and logistics for rehearsals and ministrations. 
iii. Manages the committee's budget, handling requests for equipment 
maintenance or purchase. 
iv. Keeps accurate financial records for the committee. 
4. Sub-Ministries and Leadership Roles: 
A. Praise and Worship Ministry: 
i. Praise and Worship Coordinator: 
a) Leads the team spiritually and musically, selects theologically sound songs, schedules 
and leads effective rehearsals, and mentors upcoming worship leaders. 
b) Shall be the link between the Praise and Worship Ministry and the Music Committee. 
ii. Assistant Praise and Worship Coordinator: 
a) Assists the leader in all duties, oversees administrative needs, and leads in the 
coordinator’s absence. 
b) Shall be the custodian of all the Praise and Worship ministry records. 
B. Choir Ministry: 
i. Choir Coordinator: 
a) Directs the choir, selects and arranges music, and focuses on the vocal and spiritual 
development of choir members. 


 

17 | P a g e 

 

b) Shall preside over its practice sessions. 
c) Shall be the link between the Choir Ministry and the Music Committee. 
ii. Assistant Choir Coordinator: 
a) Assists the leader, manages choir assets and leads rehearsals. 
b) Shall be the custodian of all the Choir Ministry records. 
C. Band Ministry: 
i. Band Coordinator: 
a) Shall be responsible for coordinating the Band Ministry and preside over its practice 
sessions. 
b) Shall be the link between the Band Ministry and the Music Committee. 
c) Shall be responsible of all the musical instruments. 

 

ii. Assistant Band Coordinator: 
a) He or she shall be the principal assistant to the Band Ministry Coordinator. 
b) He or shall be the custodian of all the Band Ministry records. 

 

D. Outreach and Production Ministry: 
i. Music Outreach and Production Coordinator: 
a) Shall supervise music-related responsibilities outside the main music ministry. 
b) Shall collaborate with the Technical and Media Ministry for the recording and 
production of music content.  
c) Shall be in charge of conducting singing auditions to nurture and train talents for the 
ministry. 
     ii.   Music Outreach and Production Coordinators:  
a) He or she shall be the principal assistant to the Music Outreach and Production 
Coordinator. 
b) He or shall be the custodian of all the Music Outreach and Production Ministry 
records. 

 

 

 

 

 

 


 

18 | P a g e 

 

3.4 Prayer Committee 
1. Mandate: 
To mobilize and lead the Christian Union in consistent, fervent, and effective prayer. 
2. Committee Composition: 
i. Prayer Coordinator (Chairperson), 
ii. Secretary/Treasurer 
iii. Prayer Coordinators for each year of study 
iv. Two Members 
3. Roles of the Committee Office Bearers: 
A. Chairperson (Prayer Coordinator): 
i. Shall provide overall spiritual leadership for the prayer ministry. 
ii. Shall plan and coordinate all corporate prayer meetings, prayer weeks, 
and fasting programs. 
iii. Shall identify and communicate key prayer points for the CU. 
B. Secretary/ Treasurer: 
i. Shall take minutes and handle all communications for the committee. 
ii. Shall be responsible for compiling and distributing prayer requests and 
praise reports. 
iii. Shall manage any financial resources allocated for prayer events, such 
as retreats or special materials. 
C. Year's Fellowship Prayer Coordinators: 
i. Shall be the prayer champions and mobilizers within their respective 
year groups: 
a) Anza FYT 
b) Endelea one 
c) Endelea Two 
d) VUKA FiT. 
ii. Shall organize and lead prayer sessions during their year's fellowship 
meetings. 
iii. Shall gather prayer requests from their peers and forward them to the 
committee secretary. 

 

 


 

19 | P a g e 

 

3.5 Missions and Evangelism Committee 
1. Mandate: 
To equip and mobilize the CU to faithfully proclaim the gospel in word and deed, 
both on campus and beyond, ensuring that every member is engaged in the Great 
Commission. 
2. Committee Composition: 
i. Missions and Evangelism Coordinator (Chairperson) 
ii. Secretary/Treasurer. 
iii. Sub-Ministry Coordinators 
Roles of the Committee Office Bearers: 
A. Chairperson (Missions and Evangelism Coordinator): 
i. Provides overarching strategic leadership for all CU outreach 
activities, ensuring they are aligned with the Union's vision. 
ii. Oversees the planning and execution of the annual mission and major 
evangelistic events in collaboration with the sub-committees. 
iii. Ensures all outreach teams are doctrinally sound, well-trained in 
evangelism, and mission work. 
iv. Mentors the leaders of the Evangelism, Hope, and Integral Ministry 
sub-committees. 
B. Secretary/ Treasurer: 
i. Handles all high-level correspondence for the committee, including 
writing official letters for mission ground requests, partnerships, and 
visit permissions. 
ii. Maintains a central record of all outreach activities, including statistics 
on new converts for consolidated follow-up strategies. 
iii. Manages the overall finances for all missions and evangelism 
activities, including central fundraising, budget allocation to sub-
committees, and ensuring accountability for all disbursed funds. 
3. Sub-Committees and Leadership Roles: 
A. Evangelism Sub-Committee 
i. Mandate: 
To spearhead all on-campus and off-campus evangelistic efforts, 
creating a pervasive culture of sharing the gospel within the university 
community and beyond. 
ii. Composition: 
a. Evangelism Ministry Leader, 
b. Assistant Evangelism Ministry Leader 


 

20 | P a g e 

 

c. Anza Fyt Evangelism Leader 
d. Endelea one Evangelism Leader 
e. Endelea two Evangelism Leader 
f. Vuka FiT Evangelism Leader 
iii. Leadership Roles: 
a. Evangelism Ministry Leader: Leads the sub-committee, plans 
campus-wide evangelistic activities, events and trains members 
in various methods of personal and corporate evangelism. 
b. Assistant Evangelism Ministry Leader: Supports the leader 
in all duties and may oversee specific projects or teams. 
c. Anza FYT Evangelism Leader: Focuses specifically on 
evangelism and outreach to first-year students, organizing 
targeted events and mobilizing first years to share their faith. 
d. Endelea Evangelism Leader: Focuses on continuing the 
evangelistic momentum among second and third-year students. 
e. Vuka FiT Evangelism Leader: Dedicated to evangelism 
among the finalists, addressing relevant topics and mobilizing 
them for campus outreach. 
B. Hope Ministry Sub-Committee 
i. Mandate: 
To demonstrate the compassion of Christ by ministering to 
marginalized and vulnerable groups in the surrounding community. 
ii. Composition: 
a. Hope Ministry Leader 
b. Assistant Hope Ministry Leader 
c. Three Members (At least one representative from the Anza 
FYT committee)  
iii. Leadership Roles: 
a. Hope Ministry Leader: Plans, coordinates, and leads regular 
outreach visits to hospitals, prisons, children's homes, and 
rescue centres, focusing on sharing the hope of the gospel. 
b. Assistant Hope Ministry Leader: Assists the leader with 
logistics, communication with institutions, and pre-visit 
preparations. 
c. Members: Actively participate in planning and mobilizing 
members for visits playing a key role in engaging their peers in 
compassionate outreach. 

 


 

21 | P a g e 

 

C. Integral Ministry 
i. Mandate: 
To extend the mission of the CU to specific strategic groups, such as 
high schools and children, integrating faith with practical action. 
ii. Composition: 
a. Integral Ministry Leader 
b. Assistant Integral Ministry Leader. 
iii. Leadership Roles: 
a. Integral Ministry Leader: Leads mission-focused outreach to 
local high school Christian Unions and partners with local 
churches to support their Sunday school programs. Also 
coordinates CSR as a form of street evangelism with societal 
transformation. 
b. Assistant Integral Ministry Leader: Supports the leader in all 
activities, often taking charge of either the high school or 
children's ministry. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

22 | P a g e 

 

3.6 Creative Arts Ministry Committee 
1. Mandate: 
To use diverse artistic gifts to glorify God, edify the church, and communicate the 
gospel in a compelling way. 
2. Committee Composition: 
a. Creative Arts Ministry Coordinator (Chairperson) 
b. Secretary/Treasurer 
c. Sub-Ministry Coordinators 
3. Roles of the Committee Office Bearers: 
A. Chairperson (Creative Arts Ministry Coordinator): 
i. Serves as the overall artistic and spiritual director for the creative arts 
ministry. 
ii. Coordinates major creative events like Creative Night and ensures all 
presentations are excellent and biblically sound. 
iii. Mentors and provides guidance to the leaders of the creative sub-
ministries. 
iv. Shall coordinate and oversee Transformation and Advocacy campaigns 
in the Christian Union. 
B. Secretary/ Treasurer: 
i. Handles all administrative tasks, including minutes, communication, 
and maintaining a database of ministry members. 
ii. She is responsible of asset management in the ministry. 
iii. Manages the committee's budget, including funds for costumes, props, 
and production expenses. 
4. Sub-Ministries and Leadership Roles: 
A. Drama Ministry Coordinator: 
i. Drama Ministry Coordinator: 
a. Leads the drama team, directs plays, oversees scriptwriting, and 
develops the acting skills of members. 
b. Shall coordinate the drama team’s activities and trainings. 
c. Shall be the link between the drama ministry and the Creative Arts 
Ministry Committee.  
ii. Assistant Drama Ministry Coordinator: 
a. He or she shall be the principal assistant to the Drama Ministry Leader. 
b. He or she shall be in charge of all drama ministry records and assets. 

 


 

23 | P a g e 

 

B. Dance Ministry: 
i. Dance Ministry Coordinator: 
a. Leads and choreographs for the dance team ensuring all music 
and movements are appropriate for worship and minister to the 
congregation. 
b. Shall be the link between the dance ministry and the Creative 
Arts Ministry Committee.  
ii. Assistant Dance Ministry Coordinator: 
a. Shall be the principal assistant to the dance ministry coordinator. 
b. Shall be responsible for keeping of all the ministerial records. 
C. SPARCS (Spoken Word, Poetry, Arts & Creative Skits) Ministry: 
i. SPARCS Ministry Coordinator: 
a) Coordinates all spoken word, poetry, and fine arts 
presentations. 
b) Mentors members in creative writing and ministrations. 
c) Shall be the link between the SPARCS ministry and the 
Creative Arts Ministry Committee.  
ii. Assistant SPARCS Ministry Coordinator: 
a) Shall be the principal assistant to the SPARCS ministry 
coordinator.  
b) Shall be responsible for keeping of all the ministerial records. 
D. Models Ministry: 
i. Mr. & Miss MUTCU: 
a) Shall Serve as the official leaders and coordinators of the 
Models Ministry.  
b) They act as ambassadors for the CU, promoting Christian 
character and values through fashion and creative ministrations. 
c) Shall spearhead and organize for Social Action and 
Transformation campaigns and activities within and beyond the 
institution in partnership with FOCUS. 

 

 

 


 

24 | P a g e 

 

3.7 Technical and Media Ministry 
Committee 
1. Mandate: 
To provide excellent and seamless technical and media support for all CU activities 
and to manage the Union's digital presence effectively. 
2. Committee Composition: 
i. Technical & Media Ministry Coordinator (Chairperson) 
ii. Secretary/Treasurer 
iii. Sub-ministry Leaders 
3. Roles of the Committee Office Bearers: 
A. Chairperson (Technical & Media Ministry Coordinator): 
i. Oversees all technical and media operations, ensuring a high standard 
of quality. 
ii. Ensures all equipment is well-maintained and that all technical 
operators are well-trained. 
iii. Develops the long-term technical strategy for the CU. 
B. Secretary/treasurer: 
i. Handles committee administration, including creating volunteer 
schedules, managing equipment inventory, and taking minutes. 
ii. Manages the budget for equipment purchases, repairs, software 
subscriptions, and publicity materials. 
iii. Shall be the principal assistant of the chairperson. 

 

4. Sub-Ministries and Leadership Roles: 
A. Sound Ministry: 
i. Sound Ministry Coordinator: 
Responsible for all aspects of sound reinforcement, including 
equipment setup, sound engineering during services, recording of 
sermons, and training of sound technicians. 
ii. Assistant Sound Ministry Coordinator: 
Shall be the principal assistant of the sound coordinator and manage all 
asset inventory. 

 

 


 

25 | P a g e 

 

B. Ushering Ministry: 
i. Ushering Ministry Coordinator: 
a) Leads the ushering team, responsible for creating a welcoming 
atmosphere and ensuring orderly seating. 
b) Overseeing the collecting the offering, and managing the 
smooth flow of services. 
ii. Assistant Ushering Ministry Coordinator: 
a) Shall be the principal assistant of the coordinator. 
b) Shall be the custodian of all the asset belonging to the ushering 
ministry. 
C. Publicity (MBBC) Ministry: 
i. Publicity Ministry Coordinator: 
a) Shall publicize all the events of The CU in accordance with all the 
recommendations of the committee.  
b) Shall be the custodian of all publicity materials and equipment of The 
Union.  
c) Shall convene and chair the Publicity ministry meetings. 
d) Shall be the link between the Publicity ministry and the Technical 
Committee.  
e) Shall plan, coordinate and oversee all the Publicity ministry activities 
and events.  
f) Shall coordinate the nomination of all the Publicity ministry 
departmental leaders. 

 

ii. Assistant Publicity Ministry Coordinator: 
a) Shall be the principal assistant to the coordinator. 
b) Shall be the custodian of all publicity materials and equipment of The 
Union.  
c) Shall keep records of members attendance and responsibilities. 

 

 

 

 


 

26 | P a g e 

 

D. Digital Ministry: 
i. Digital Ministry coordinator: 
a) Shall manage the CU’s website, all social media platforms, 
livestreaming operations, and the creation of digital content 
(videos, graphics). 
b) Shall oversee the training of members in the relevant skills for 
the ministry. 
c) Shall ensure the Digital Ministry policies are upheld as per the 
policy framework. 
ii. Assistant Digital Ministry coordinator: 
a) Shall be the principal assistant to the coordinator. 
b) Shall be the custodian of all Digital ministry asset of The Union. 
c) Shall keep records of members attendance and responsibilities. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

27 | P a g e 

 

3.8 Welfare Committee 
1. Mandate: 
To demonstrate Christ's love by providing practical, emotional, and spiritual support 
to members in need. 
2. Committee Composition: 
i. Welfare Coordinator 
ii. First Vice-Chairperson (Female) 
iii. Second Vice-Chairperson (Male) 
iv. The CU Treasurer 
v. Secretary/ Treasurer 
vi. Guidance & Counselling coordinators 
vii. Ladies' Sub-committee 
viii. Gents' Sub-committee 
ix. Anza FyT chairperson 
3. Roles of the Committee Office Bearers: 
A. Chairperson (Welfare Coordinator): 
i. Provides overall leadership to the committee and confidentially 
oversees all welfare cases. 
ii. Convenes meetings to review requests for support and make decisions 
based on established policies. 
B. Secretary/ treasurer: 
i. Confidentially handles and documents all welfare cases, ensuring 
privacy and proper record-keeping. 
ii. Manages all committee records and communications. 
iii. Manages the welfare fund, tracks donations, and disburses support as 
approved by the committee. 
iv. Coordinates fundraising efforts specifically for members in need. 

 


 

28 | P a g e 

 

4. Sub-Committee Leadership Roles: 
A. Christian Union Treasurer 
Shall advice the Welfare Committee on the financial position of The Union 
relative to the welfare account. 
B. Guidance & Counselling Coordinators: Leads the counselling team, 
provides confidential pastoral care and biblical guidance, and refers complex 
cases to the university Guidance & Counselling department. 
C. Ladies' Sub-committee Lead (First Vice-Chairperson): 
Leads a team of female leaders in planning and executing programs (talks, 
mentorship, events) that cater specifically to the spiritual and social needs of 
ladies. 
D. Gents' Sub-committee Lead (Second Vice-Chairperson): 
Leads a team of male leaders in planning and executing programs 
(fellowships, gents forums) that build up men in their faith, character, and 
leadership. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

29 | P a g e 

 

3.9 Bible Study and Training Committee 
1. Mandate: 
To facilitate the systematic spiritual growth of members through the in-depth study of 
God's Word in small groups and structured self-training programs. 

 

2. Committee Composition: 
i. The Bible Study and Training Coordinator (Chairperson) 
ii. The Secretary/Treasurer 
iii. The Bible Study Coordinator 
iv. The Assistant Bible Study Coordinator 
v. The BEST-P Coordinator 
vi. The Assistant BEST-P Coordinator 
vii. Consistent Bible Reading Coordinator 
viii. Assistant Bible Reading Coordinator 

3. Roles of the Committee Office Bearers: 
A. Chairperson (Bible Study &Training Coordinator): 
a. Performs all duties as outlined in Part 2.10 of this manual. 

 

B. Secretary/Treasurer: 
a. He/she takes minutes during the ministry’s meeting and avails them 
for reading and confirmation in every meeting. 
b. He/she is the custodian of all committee funds, documents and 
assets. 
c. He/she is in charge of special activities within the committee. 
d. Shall be the financial advisor to the committee. 

 

C. The Bible Study Coordinator: 
a. Coordinating the committee members to ensure they follow up Bible 
study leaders for effective running of the small Bible Study groups. 
b. Issuing of the Bible study guides and collecting monies. 
c. Oversee the coordination of the Bible study review on Mondays at 
4:00 p.m. 
d. He/she oversees special activities of the committee e.g Bereans. 

 

D. The Assistant Bible Study Coordinator: 
a. He/she shall collect, record and store data on small Bible study group 
meetings every Monday. 


 

30 | P a g e 

 

b. He/she is the principal assistant. 

 

E. Duties of the Bible Study Sub-Committee: 
a. Shall assign different Bible study leaders to different Bible study 
groups. 
b. In charge of Bible study leaders training. 
c. Shall form and dissolve Bible study groups upon completion. 

 

F. The BEST-P Coordinator: 
a. He/she ensure that the BEST-P classes are on-going well. 
b. He/she selects facilitators of various BEST-P topics. 
c. He/she plans and coordinates the BEST-P graduation. 

 

G. The Assistant BEST-P Coordinator: 
a. He/she plans and coordinates the formation of the BEST-P groups 
and assignments. 
b. He/she ensures proper record keeping and attendance. 
c. He/she is the principal assistant of the BEST-P coordinator. 
H. Consistent Bible Reading Coordinator 
a) Develop and promote strategic plans to encourage consistent, 
personal Bible reading across the entire CU. 
b) May manage reading-plan groups, share devotional resources, and 
track engagement. 
I. Assistant Consistent Bible Reading Coordinator 
a. He/she plans and coordinates the formation of the CBR groups and 
assignments. 
b. He/she ensures proper record keeping and attendance. 

 

 

 

 


 

31 | P a g e 

 

3.10 Discipleship Committee 
1. Mandate: 
To intentionally guide members at every stage of their faith journey, from their first 
decision (nurturing) to relational growth (fellowships) and personal discipleship. 

 

2. Committee Composition: 
i. The Discipleship Coordinator (Chairperson) 
ii. The Secretary/Treasurer 
iii. The Nurturing Coordinator 
iv. The Assistant Nurturing Coordinator 
v. The Years Fellowship Coordinator 
vi. The Assistant Years Fellowship Coordinator 
vii. The Accountability Coordinator 
viii. The Assistant Accountability Coordinator 
ix. Discipleship class coordinator 
x. Assistant Discipleship Coordinator 

3. Roles of the Committee Office Bearers: 
A. Chairperson (Discipleship Coordinator): 
i. Performs all duties as outlined in Part 2.11 of this manual. 
B. Secretary/Treasurer: 
i. He/she takes minutes during the ministry’s meeting and avails them for 
reading and confirmation in every meeting. 
ii. He/she is the custodian of all committee funds, documents and assets. 
iii. He/she is in charge of special activities within the committee. 
iv. Shall be the financial advisor to the committee. 

 

C. The Nurturing Coordinator: 
i. He/she is in charge of the new believers nurturing class. 
ii. He/she chairs the Nurturing sub-committee’s meeting. 
iii. He/she ensures proper follow up of the new believers assigned to 
various disciple makers. 
iv. He/she oversee special activities of the committee i.e baptism. 
D. The Nurturing Coordinator: 
i. Shall be the principal assistant to the nurturing coordinator. 


 

32 | P a g e 

 

ii. Shall be the custodian of all assets and records. 

 

E. Duties of the Nurturing Sub-Committee: 
i. In charge of coming up with topics and facilitators of nurturing classes. 
ii. Shall allocate new believers to various disciple makers. 
iii. Shall organize for both baptism and training of members being 
baptized. 
F. The Years Fellowship Coordinator: 
i. He/she ensures that all year fellowships are running effectively. 
ii. He/she ensures that all the year fellowships are coordinated. 
iii. He/she ensures that every year’s fellowship leaders come with topics 
and the facilitators each spiritual year. 
iv. He/she coordinates special activities within the yearly fellowships. 
v. He/she ensures all the year’s fellowship leaders work together in 
oneness and cooperation. 
G. The Assistant Years Fellowship Coordinator: 
i. He/she is the principal assistant of the year’s fellowship coordinator. 
ii. He/she ensures proper record keeping and attendance. 
H. Duties of the Years Fellowship Sub-Committee: 
i. Coordinates of weekly fellowships. 
ii. Come up with topics and facilitators for every spiritual year 
fellowships. 

 

I. Accountability Coordinator 
i. Champion the importance of personal accountability for spiritual growth 
and purity. 
ii. Develop resources and systems to help members form healthy 
accountability groups. 
iii. May organize and provide training to accountability group leaders. 
J. Assistant Accountability Coordinator 
i. Shall be the principal assistant to the accountability coordinator. 
ii. Shall be the custodian of all assets and records. 

 

 


 

33 | P a g e 

 

J. Discipleship Class Coordinator 

i. Organize and run structured discipleship classes on foundational 
Christian doctrines, spiritual disciplines, and practical Christian 
living. 
ii. Select curriculum and recruit mature facilitators for these classes, 
distinct from nurturing. 
K. Assistant Discipleship Coordinator 

i. Shall be the principal assistant to the discipleship class coordinator. 
ii. Shall be the custodian of all assets and records. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

34 | P a g e 

 

Part 3: General Committees & Ministries 
Roles 
3.1 Treasury Committee 
1. Mandate: 
To ensure financial integrity, accountability, and proper management of all CU funds 
in support of the CU Treasurer. 
2. Committee Composition: 
i. The CU Treasurer (Chairperson) 
ii. Treasurers from all other General Committees. 
iii. Asset Manager 
3. General Duties of the Committee: 
i. Shall harmonize all of The Christian Union’s ministerial budgets. 
ii. Shall be responsible for the counting and banking of all Christian Union 
monies. 
iii. Shall provide training and guidance to all committee treasurers on financial 
procedures, budgeting, and reporting. 
iv. Shall ensure the proper management of CU assets. 
4. Roles of the Committee Office Bearers: 
i. Chairperson (CU Treasurer): 
Performs all duties as outlined in Part 2.6 of this manual. Convenes and chairs 
all Treasury Committee meetings. 
ii. Committee Treasurers (Members): 
a) Shall prepare, propose, and manage the budget for their respective 
committees. 
b) Shall be responsible for all financial record-keeping within their 
committee. 
c) Shall ensure all financial requests from their committee adhere to the 
CU's financial policies. 

 

 

 


 

35 | P a g e 

 

3.2 Hospitality Committee 
1. Mandate: 
To model the love of Christ by creating a welcoming environment, caring for guests 
and members, and managing CU office resources. 

 

2. General Duties of the Committee: 
i. Shall be in charge of all Hospitality Ministry activities. 
ii. Shall register and induct new members into the hospitality ministry. 
iii. Shall prepare all hospitality ministry budgets. 
iv. Oversee the working of all hospitality programs and visitor care ministries. 
v. Be alert to the needs of The CU membership and ways to serve those needs. 
3.3 Music Committee 
1. Mandate: 
To lead the congregation in authentic, biblical, and excellent worship through music. 
2. General Duties of the Committee: 
i. Be in charge of organizing events that pertain to the Music ministry. 
ii. Organize training sessions for members of the music ministries. 
iii. Plan proper practicing schedules for the various ministries in the committee. 
3.4 Prayer Committee 
1. Mandate: 
To mobilize and lead the Christian Union in consistent, fervent, and effective prayer. 
2. General Duties of the Committee: 
i. Shall organize all prayer meetings for The CU members (e.g., prayer weeks, 
fasts). 
ii. Shall identify and communicate key prayer points for the CU. 
iii. Shall encourage all members in the church to build a culture of prayer. 
3.5 Missions and Evangelism Committee 
1. Mandate: To equip and mobilize the CU to faithfully proclaim the gospel in word 
and deed, both on campus and beyond. 
2. General Duties of the Committee: 
i. Be responsible for all of The Union's outreaches (missions, rallies, open-air 
meetings, etc.). 
ii. Organize training sessions on evangelism and missions for members. 


 

36 | P a g e 

 

3.6 Creative Arts Ministry Committee 
1. Mandate: 
To use diverse artistic gifts to glorify God, edify the church, and communicate the 
gospel in a compelling way. 
2. General Duties of the Committee: 
i. Shall organize creative events such as Creative Night. 
ii. Organize training sessions for the various ministries under it. 
iii. Ensure all ministrations are biblically sound and edifying. 
3.7 Technical and Media Ministry Committee 
1. Mandate: 
To provide excellent technical and media support for all CU activities and manage the 
Union's digital presence. 
2. General Duties of the Committee: 
i. Oversee all media and technical activities in the church. 
ii. Do all The CU’s decorations and publicize all activities. 
iii. Shall be custodians of the instruments and technical assets. 
iv. Organize training sessions for technical teams. 
3.8 Welfare Committee 
1. Mandate: 
To demonstrate Christ's love by providing practical, emotional, and spiritual support 
to members in need. 
2. General Duties of the Committee: 
i. Shall liaise with The Union members to identify those in need and assist them. 
ii. Shall approve and issue support to needy members based on established 
policies. 
iii. Shall be in charge of preparing the Welfare Committee budgets. 
iv. Shall provide pastoral care and counselling to members. 

 

3.9 Bible Study and Training Committee 
1. Mandate: 
To facilitate the systematic spiritual growth of members through the in-depth study of 
God's Word in small groups and structured self-training programs. 
2. General Duties of the Committee: 
i. Shall select suitable and relevant Bible study guides. 


 

37 | P a g e 

 

ii. Shall assign leaders to Bible study groups. 
iii. Shall be in charge of training Bible study leaders. 
iv. Shall oversee the administration of the BEST-P program. 
v. Shall organize the BEST-P graduation. 
3.10 Discipleship Committee 
1. Mandate: 
To intentionally guide members at every stage of their faith journey, from their first 
decision (nurturing) to relational growth (fellowships) and personal discipleship. 
2. General Duties of the Committee: 
i. Shall organize for both baptism and training of new believers. 
ii. Shall oversee the Nurturing classes for new converts. 
iii. Shall allocate new believers to disciple-makers for follow-up. 
iv. Shall train Years' Fellowship leaders. 
v. Shall oversee the election and running of all Years' Fellowships. 

 

 

 

 

 

 

 

 

 

 

 

 

 

 


 

38 | P a g e 

 

Part 4: Special Committees: Mandate, 
Composition & Roles 
This section provides a detailed breakdown of the Special Committees, which are appointed 
by the Executive Council to serve specific governance, oversight, and strategic functions, as 
outlined in the Constitution. 
4.1 The Advisory Board 
1. Mandate: 
To assist and advise the leadership, providing wisdom, counsel, and an external 
perspective to ensure accountability and healthy governance. The Board may engage 
in events, functions, or activities that further the aims of the CU. 

 

2. Composition: 
i. The Patron (Chairperson and Convener) 
ii. The Assistant Patron (Vice Chairperson) 
iii. The Christian Union Chairperson (Secretary) 
iv. Two Associates of The Christian Union (formerly Alumni) 
v. FOCUS Staff (Assigned to MUTCU) 
vi. One Member (Who ascribes to the Christian faith, upholds the doctrinal 
basis, and is not a student). 

 

3. Term of Service: The Board shall be appointed by the Executive Council (ideally 
within three weeks of taking office) and shall serve for one spiritual year. Members 
may be re-appointed. 

 

4. Roles and Responsibilities: 
i. General: 
a) Be available to advise, counsel, and encourage the CU leaders and 
members as necessary. 
b) Acquaint themselves with the organization and activities of The Union 
to offer relevant and effective assistance. 
c) Attend Executive Council meetings when formally requested, to 
provide guidance on specific matters. 
d) Assist in dispute resolution as per Article 28 of the Constitution. 
e) Provide an opinion on any proposed constitutional amendments, as per 
Article 23(ii). 


 

39 | P a g e 

 

ii. Meetings: 
a) The Board shall be mandated to meet at least once a spiritual year. 
b) It is highly recommended that at least two-thirds (2/3) of the Advisory 
Board members meet with the full Executive Council at least twice per 
spiritual year (once per semester) for strategic review, encouragement, 
and accountability. 
4.2 The Auditing Committee 
1. Mandate: 
To independently audit and inspect all of The Christian Union’s books of accounts, 
assets, and liabilities. Its primary purpose is to ensure financial transparency, promote 
accountability, and protect The Union's assets. 

 

2. Composition: 
i. Two Internal Auditors (Appointed by the Executive Council from the 
general membership, must not be office-bearers). 
ii. The Christian Union’s Asset Manager (Appointed by the Executive 
Council). 

 

3. Roles and Responsibilities of the Auditing Committee: 
i. Audit and inspect all books of accounts, assets, and liabilities. 
ii. Prepare and present an official report on all financial information regarding 
The Christian Union to the EC and the AGM. 
iii. Ensure the protection of The Christian Union’s assets. 
iv. Facilitate the independence of the External Auditor (as per Art 21). 
v. Consider all significant matters raised during the audit process and advise the 
Executive Council on best practices and corrective actions. 
4. Roles and Responsibilities of the Asset Manager: 
i. Be in charge of all of The Union's assets. 
ii. Keep and diligently update the CU’s official asset register, including details of 
purchase, condition, and location. 
iii. In consultation with the Executive Council, oversee the purchase and disposal 
of The Union's assets. 
iv. Authorize and maintain a record of any CU assets that are leased, rented, or 
lent out, ensuring adherence to CU policy. 
v. Handle any loss of or damage to assets, providing a report to the Executive 
Council. 
vi. Formulate and update regulations and procedures governing the use, lease, or 
lending of The Union's assets, subject to ratification by the Executive Council. 


 

40 | P a g e 

 

4.3 Resource Mobilization Committee (RMC) 
1. Mandate: 
To plan, coordinate, implement, and oversee strategies for generating financial and 
material resources to support the vision and activities of The Christian Union. 
2. Composition: 
i. Chairperson: A dedicated member appointed by the EC. 
ii. Secretary: A member appointed by the EC. 
iii. Treasurer: A member appointed by the EC. 
iv. The Christian Union's Treasurer (Ex-officio member) 
v. Associates Representative: A member from the Associates Committee. 
vi. Three to Five (3-5) General Members: Full members known for integrity 
and innovative thinking. 
3. Roles and Responsibilities: 
i. Strategic Planning: Formulate an annual resource mobilization plan in 
consultation with the Executive Council, outlining targets, activities, and 
timelines. 
ii. Fundraising: Plan, coordinate, and execute all official fundraising events, 
campaigns, and activities for The Christian Union. 
iii. Donor Engagement: Identify and cultivate relationships with potential and 
existing partners, including Associates, church partners, and other well-
wishers. 
iv. Proposal Writing: Draft compelling proposals for specific projects (e.g., 
missions, asset acquisition) to be presented to potential sponsors. 
v. Collaboration: Work closely with the CU Treasurer to ensure all generated 
funds are properly documented and channeled, and with other committees to 
understand their financial needs. 
vi. Reporting: Provide regular, detailed reports on all fundraising activities to the 
Executive Council and a summary report for the Annual General Meeting 
(AGM). 
vii. Stewardship: Promote a culture of stewardship, generosity, and financial 
accountability within The Christian Union. 


 

41 | P a g e 

 

4.4 The Associates Committee (Alumni) 
1. Mandate: 
To keep and maintain a strong, active, and mutually beneficial link between the 
Christian Union and its Associates (Alumni) community. 
2. Composition: 
i. The Chairperson 
ii. The Secretary 
iii. The Treasurer 
iv. The Male Vice Chairperson of The Christian Union 
3. Roles and Responsibilities: 
i. Maintain and regularly update the Associates (Alumni) database. 
ii. Act as the primary communication link between the CU and its Associates. 
iii. Plan, coordinate, and execute the "Associates' Weekend" or any other alumni-
focused events. 
iv. The executive appointees (Chair, Secretary, Treasurer) shall be responsible for 
the regular activities of the Committee. 
v. The Male Vice Chairperson shall represent the interests of the current 
Executive Council to the committee. 
4.5 The Interim Executive Council (May-August 
Session) 
1. Mandate: 
To provide spiritual leadership, governance, and ensure the continuity of ministry 
during the May-August semester. This council serves the members who remain on 
campus for tri-semester studies or are based nearby for industrial attachment. 
Note: This committee is distinct from the "Interim Executive Council" formed by the 
Advisory Board in the event of a full EC dissolution (as per Art 12.7.d). 

 

2. Term of Service: This council is appointed by the main Executive Council before the 
end of the second semester and serves from May through August. 
3. Composition: 
i. The Chairperson 


 

42 | P a g e 

 

ii. The Vice Chairperson (Male or Female) 
iii. The Secretary 
iv. The Treasurer 
v. The Prayer Coordinator 
vi. The Music Coordinator 
vii. The Missions and Evangelism Coordinator 
viii. The Bible Study and Discipleship Coordinator 
ix. The Technical and Media Ministry Coordinator 
x. The Creative Arts Ministry Coordinator 
4. Roles and Responsibilities: 
i. Perform the core duties of the Executive Council (as outlined in Part 2) but 
adapted for the smaller, specific congregation. 
ii. Plan and execute regular fellowships, prayer meetings, and Bible studies. 
iii. Provide pastoral care and support for the members present during the session. 
iv. Manage the CU budget and assets allocated for the May-August session with 
full accountability. 
v. Maintain communication with the main Executive Council and the Patron. 
vi. Prepare and submit a comprehensive handover report to the main Executive 
Council at the beginning of the new spiritual year. 
5. Sub-Committees: 
i. The Interim Executive Council shall have the authority to appoint sub-
committee members as they deem necessary to effectively run the ministry 
during their term. 

 

Conclusion 
This manual is a tool to empower, not to restrict. It is designed to bring order and excellence 
to our service, freeing us to focus on our ultimate goal: inspiring love, hope, and godliness. 
Let us all commit to servant leadership, working together in unity and love, for the glory of 
God alone. 

 

2. Security First: The PHP backend we are about to build must strictly use PDO prepared statements to prevent SQL injection. Passwords must be hashed using bcrypt.
3. Mobile-First: All Tailwind CSS additions must be fully responsive.
4. Clean Architecture: Keep components modular. As we move forward, we will break App.jsx into smaller, manageable components (e.g., /components, /pages, /hooks).

# YOUR IMMEDIATE TASK
Do not generate any code yet. 

1. Acknowledge that you have read the Blueprint, the attached Constitution, the Leadership Manual, and the Prototype Code.
2. Based on the data requirements in the prototype and the manuals, propose a complete, normalized MySQL Database Schema (SQL CREATE TABLE statements) to support this application. Ensure you include tables for `users`, `ministries`, `user_ministry_roles`, and `system_content` (for the Admin CMS).
3. Wait for my approval on the database schema before we begin writing the PHP REST API.